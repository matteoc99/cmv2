<?php

namespace App\Services;

use App\Models\Plan;
use App\Traits\ConsumesExternalServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayPalService
{
    use ConsumesExternalServices;

    protected $baseUri;
    protected $clientId;
    protected $clientSecret;
    protected $plans;

    public function __construct()
    {
        $this->baseUri = config("services.paypal.base_uri");
        $this->clientId = config("services.paypal.client_id");
        $this->clientSecret = config("services.paypal.client_secret");
        $this->plans = config("services.paypal.plans");
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers["Authorization"] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");
        return "Basic {$credentials}";
    }

    public function handleSubscription(Request $request,Plan $plan){
        $subscription=$this->createSubscription(
            $plan,
            Auth::user()->name,
            Auth::user()->email
        );

        $subscriptionLinks = collect($subscription->links);
        $approve = $subscriptionLinks->where("rel", "=", "approve")->first();

        session()->put("subscriptionId", $subscription->id);
        return redirect($approve->href);

    }

    public function validateSubscription(Request $request){
        if(session()->has("subscriptionId")){
            $subscriptionId =session()->get("subscriptionId");
            session()->forget("subscriptionId");
            return $request->get("subscription_id")==$subscriptionId;
        }
        return false;
    }

    public function handleCancellation($subscriptionId){
        return $this->makeRequest("POST", "/v1/billing/subscriptions/{$subscriptionId}/cancel", [], [
            "reason"=>"not satisfied"
        ], [], true);
    }
    public function createSubscription($plan,$name,$email){

        return $this->makeRequest("POST", "v1/billing/subscriptions", [], [
            'plan_id' => $this->plans[$plan->name],
            'subscriber' => [
                "name"=>[
                    "given_name"=>$name,
                ],
                "email_address"=>$email,
            ],
            "application_context" => [
                "brand_name" => config("app.name"),
                "shipping_preference" => "NO_SHIPPING",
                "user_action" => "SUBSCRIBE_NOW",
                "return_url" => route("subscribe.approved",$plan->id),
                "cancel_url" => route("subscribe.declined",$plan->id),
            ]
        ], [], true);
    }
}
