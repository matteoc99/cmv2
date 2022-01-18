
<ul id="nav-mobile" class="sidenav">
    <h5 href="#" class="brand-logo center pistachio">
        Condominium&nbsp;Manager
    </h5>
    <li><a data-value="features" class="scrollto">Features</a></li>
    <li><a data-value="pricing" class="scrollto">Pricing</a></li>
    @if(is_null(Auth::user()))
        <li><a href="{{route("login")}}">Login</a></li>
        <li><a href="{{route("register")}}">Register</a></li>
    @endif
</ul>
<div class="navbar-fixed">
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="#en" data-value="en" class="lang-change "><span id="en-switch" class="pistachio">English</span></a>
        </li>
        <li><a href="#de" data-value="de" class="lang-change "><span id="de-switch" class="pistachio">Deutsch</span></a>
        </li>
        <li><a href="#it" data-value="it" class="lang-change "><span id="it-switch"
                                                                     class="pistachio">Italiano</span></a></li>
    </ul>
    <nav class="main-blue-bg" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" data-value="top"
               class="brand-logo center hide-on-med-and-down hide-on-large-only show-on-extra-large scrollto">
                Condominium&nbsp;Manager
            </a>
            <ul class="left hide-on-med-and-down">
                <li><a data-value="features" class="scrollto">Features</a></li>
                <li><a data-value="pricing" class="scrollto">Pricing</a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Dropdown<i
                            class="material-icons right">arrow_drop_down</i></a>

            </ul>
            <ul class="right hide-on-med-and-down">
                @if(is_null(Auth::user()))
                    <li><a href="{{route("login")}}">Login</a></li>
                    <li><a href="{{route("register")}}">Register</a></li>
                @else
                    <li><a href="{{route("logout")}}">Logout</a></li>
                @endif
            </ul>

            <a href="#!" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
</div>


