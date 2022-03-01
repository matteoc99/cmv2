@extends("layouts.dashMaster")

@section("content")

    <div class="container">
        @include("components.session_messages")
        <div class="row">
            <div class="col s12 m12 l8 xl6 card offset-l2 offset-xl3">
                <ul class="tabs">
                    <li class="tab col s4"><a href="#profile"
                                              class="blue-text darken-4 {{session()->has('tab')&&session()->get('tab')=="profile"?"active":""}}">Profile</a>
                    </li>
                    <li class="tab col s4"><a href="#notification"
                                              class="blue-text darken-4 {{session()->has('tab')&&session()->get('tab')=="notification"?"active":""}}">Notifications</a>
                    </li>
                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                        <li class="tab col s4"><a href="#subscription"
                                                  class="blue-text darken-4 {{session()->has('tab')&&session()->get('tab')=="subscription"?"active":""}}">Subscription</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div id="profile" class="col s12">
                @include("components.boxes.profileSettingBox",["img"=>$img,"setting"=>$setting])
            </div>
            <div id="notification" class="col s12">
                @include("components.boxes.notificationSettingBox",["setting"=>$setting])
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                <div id="subscription" class="col s12">
                    @include("components.boxes.subscriptionSettingsBox")
                </div>
            @endif
        </div>

        <div class="row">
            @if(session()->has('success'))
                @include("components.successToast")
            @endif
        </div>
    </div>
@endsection
