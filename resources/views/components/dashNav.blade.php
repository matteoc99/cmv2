<ul id="nav-mobile" class="sidenav">
    <h5 href="#" class="brand-logo center light-green-text">
        Condominium&nbsp;Manager
    </h5>
    <li><a href="{{route("dashboard")}}">Dashboard</a></li>
    @include("components.langSelect")
    <li><a href="{{route("settings")}}">Settings</a></li>
    @auth
        <ul id="userDrop" class="dropdown-content">
            <li><a href="{{route("settings")}}" class="light-green-text">Profile</a></li>
            <li><a href="{{route("logout")}}" class="light-green-text">Logout</a></li>
        </ul>
        <li><a class="dropdown-trigger" href="#!" data-target="userDrop">{{\Illuminate\Support\Facades\Auth::user()->name()}}<i
                    class="material-icons right">arrow_drop_down</i></a>
    @endauth
    @guest
        <li><a href="{{route("login")}}">Login</a></li>
        <li><a href="{{route("register")}}">Register</a></li>
    @endguest
</ul>
<div class="navbar-fixed">
    <nav class="blue darken-4" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" data-value="top"
               class="brand-logo hide-on-med-and-down show-on-extra-large">
                Condominium&nbsp;Manager
            </a>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{route("dashboard")}}">Dashboard</a></li>
                <li><a href="{{route("settings")}}">Settings</a></li>
                @include("components.langSelect")
                @auth
                    <ul id="userDrop" class="dropdown-content">
                        <li><a href="{{route("settings")}}" class="light-green-text">Profile</a></li>
                        <li><a href="{{route("logout")}}" class="light-green-text">Logout</a></li>
                    </ul>
                    <li><a class="dropdown-trigger" href="#!" data-target="userDrop">{{\Illuminate\Support\Facades\Auth::user()->name()}}<i
                                class="material-icons right">arrow_drop_down</i></a>
                @endauth
                @guest
                    <li><a href="{{route("login")}}">Login</a></li>
                    <li><a href="{{route("register")}}">Register</a></li>
                @endguest
            </ul>

            <a href="#!" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
</div>
