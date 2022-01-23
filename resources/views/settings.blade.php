@extends("layouts.dashMaster")

@section("content")

    <div class="container">
        <div class="row">
            <div class="col s12 m12 l8 xl6 card offset-l2 offset-xl3">
                <ul class="tabs">
                    <li class="tab col s6"><a href="#profile"
                                              class="blue-text darken-4 {{session()->has('success')&&session()->get('success')=="profile"?"active":""}}">Profile</a>
                    </li>
                    <li class="tab col s6"><a href="#notification" class="blue-text darken-4 {{session()->has('success')&&session()->get('success')=="notification"?"active":""}}">Notifications</a></li>
                </ul>
            </div>
            <div id="profile" class="col s12">
                @include("components.profileSettingBox",["img"=>$img,"setting"=>$setting])
            </div>
            <div id="notification" class="col s12">
                @include("components.notificationSettingBox",["setting"=>$setting])
            </div>
        </div>

        <div class="row">
            @if(session()->has('success'))
                @include("components.successToast")
            @endif
        </div>
    </div>
@endsection
