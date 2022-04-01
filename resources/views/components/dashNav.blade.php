<ul id="nav-mobile" class="sidenav">
    <h5 href="#" class="brand-logo center light-green-text">
        @lang("navigation.brandName")
    </h5>
    <li><a href="{{route("dashboard")}}">@lang("navigation.dashboard")</a></li>
    @include("components.langSelect",["id"=>"langmobile"])
    <li><a href="{{route("settings")}}">@lang("navigation.settings")</a></li>
    @auth
        <ul id="userDropModal" class="dropdown-content">
            <li><a href="{{route("settings")}}" class="light-green-text">@lang("navigation.profile")</a></li>
            <li><a href="{{route("logout")}}" class="light-green-text">@lang("navigation.logout")</a></li>
        </ul>
        <li><a class="dropdown-trigger" href="#!" data-target="userDropModal">{{\Illuminate\Support\Facades\Auth::user()->name()}}<i
                    class="material-icons right">arrow_drop_down</i></a>
    @endauth
    @guest
        <li><a href="{{route("login")}}">@lang("navigation.login")</a></li>
        <li><a href="{{route("register")}}">@lang("navigation.register")</a></li>
    @endguest
</ul>
<div class="navbar-fixed">
    <nav class="blue darken-4" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" data-value="top"
               class="brand-logo hide-on-med-and-down show-on-extra-large">
                @lang("navigation.brandName")
            </a>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{route("dashboard")}}">@lang("navigation.dashboard")</a></li>
                <li><a href="{{route("settings")}}">@lang("navigation.settings")</a></li>
                @include("components.langSelect",["id"=>"lang"])
                @auth
                    <ul id="userDrop" class="dropdown-content">
                        <li><a href="{{route("settings")}}" class="light-green-text">@lang("navigation.profile")</a></li>
                        <li><a href="{{route("logout")}}" class="light-green-text">@lang("navigation.logout")</a></li>
                    </ul>
                    <li><a class="dropdown-trigger" href="#!" data-target="userDrop">{{\Illuminate\Support\Facades\Auth::user()->name()}}<i
                                class="material-icons right">arrow_drop_down</i></a>
                @endauth
                @guest
                    <li><a href="{{route("login")}}">@lang("navigation.login")</a></li>
                    <li><a href="{{route("register")}}">@lang("navigation.register")</a></li>
                @endguest
            </ul>

            <a href="#!" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
</div>
