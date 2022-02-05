<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlatform;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Resolvers\PaymentPlatformResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    private $paymentPlatformResolver;

    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }

    public function show(Plan $plan)
    {
        return view("subscribe", ["plan"=>$plan,"platforms" => PaymentPlatform::where("subscription_enabled", "=", true)->get()]);
    }

    public function subscribe(Request $request,Plan $plan)
    {
        $request->validate([
            "platform" => "required|exists:payment_platforms,id"
        ]);

        $paymentPlatform = $this->paymentPlatformResolver->resolveService($request->get("platform"));
        session()->put("platform", $request->get("platform"));

        return $paymentPlatform->handleSubscription($request,$plan);
    }
    public function cancel()
    {
        $paymentPlatform = $this->paymentPlatformResolver->resolveService(Auth::user()->subscription()->platform_id);
        $paymentPlatform->handleCancellation(Auth::user()->subscription()->subscription_id);
        Auth::user()->subscription()->delete();
        return redirect()->route("settings")->with("success", ["Your Subscription has been cancelled"]);
    }
    public function manualCancel(Request $request){
        return dd($request);
    }

    public function approved(Request $request,Plan $plan)
    {
        if (session()->has("platform")) {
            $paymentPlatform = $this->paymentPlatformResolver->resolveService(session()->get("platform"));
            if ($paymentPlatform->validateSubscription($request)) {
                $user = Auth::user();
                $subscription = new Subscription();
                if(!is_null($user->subscription()))
                    $subscription=$user->subscription();
                $subscription->active_until = now()->addDays($plan->duration_in_days);
                $subscription->user_id = $user->id;
                $subscription->plan_id = $plan->id;
                $subscription->platform_id = session()->get("platform");
                $subscription->subscription_id=$request->get("subscription_id");
                $subscription->save();
                return redirect()->route("settings")->with("success", ["thanks, {$user->name}. You are now Subscribed"]);
            }
        }
        return redirect()->route("subscribe.show",$plan->id)->withErrors("We can not verify your subscription");
    }

    public function declined(Plan $plan)
    {
        return redirect()->route("subscribe.show",$plan->id)->withErrors("The Process was cancelled");
    }
}
