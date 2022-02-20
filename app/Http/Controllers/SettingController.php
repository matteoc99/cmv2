<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Nette\Utils\Image;

class SettingController extends Controller
{

    public function show(Request $request)
    {
        if (is_null(Auth::user()->setting_id)) {
            $set = new Setting();
            $set->save();
            Auth::user()->setting_id = $set->id;
            Auth::user()->save();
        }
        $set = Auth::user()->setting();
        $img = asset("uploads/default.jpg");
        if ($set->hasPicture()) {
            $img = asset("uploads/" . $set->picture()->uuid . "." . $set->picture()->mime_type);
        }
        return view("settings", ["setting" => $set, "img" => $img]);
    }


    public function updateNotification(Request $request)
    {
        $set = Auth::user()->setting();
        $set->recive_ticket_created_notification = $request->get("ticket_notification") == "on";
        if (!is_null($request->get("estimate_notification")))
            $set->revice_approved_estimate_notification = $request->get("estimate_notification") == "on";
        else
            $set->revice_approved_estimate_notification=false;
        $set->save();
        return redirect()->back()->with('tab', "notification");
    }

    public function update(Request $request)
    {


        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:6000',
        ]);
        $set = Auth::user()->setting();
        $set->first_name = $request->get("first_name");
        $set->last_name = $request->get("last_name");
        $set->desc = $request->get("desc");
        $set->firm_name = $request->get("firm_name");
        $set->phone = $request->get("phone");
        $set->address = $request->get("address");

        foreach (Auth::user()->userTags()->get() as $userTag) {
            UserTag::where("tag_id", "=", $userTag->id)->where("user_id", "=", Auth::user()->id)->delete();
        }

        if (!is_null($request->get("tags")))
            foreach ($request->get("tags") as $tag) {
                $userTag = new UserTag();
                $userTag->user_id = Auth::user()->id;
                $userTag->tag_id = $tag;
                $userTag->save();
            }

        if (!is_null($request->get("lat"))&&!is_null($request->get("lng"))){
            $set->lat=$request->get("lat");
            $set->lng=$request->get("lng");
        }


        if ($request->hasFile("profile_image")) {
            $uuid = Str::uuid()->toString();
            $ext = $request->profile_image->extension();
            $imageName = $uuid . '.' . $ext;
            $request->profile_image->move(public_path('uploads'), $imageName);
            $img = new Picture();
            $img->uuid = $uuid;
            $img->mime_type = $ext;
            $img->save();
            // TODO delete old img?
            if ($set->hasPicture()) {
                $old = $set->picture();
                try {
                    unlink(public_path('uploads/' . $old->uuid . "." . $old->mime_type));
                } catch (\Exception $ignored) {

                }
            }
            $set->profile_picture_id = $img->id;
        }
        $set->save();

        return redirect()->back()->with('tab', "profile");
    }

    public function setListView(Request $request){
        $set = Auth::user()->setting();
        $set->condominium_box_view=false;
        $set->save();
        return redirect()->back();
    }

    public function setBoxView(Request $request){
        $set = Auth::user()->setting();
        $set->condominium_box_view=true;
        $set->save();
        return redirect()->back();
    }
}
