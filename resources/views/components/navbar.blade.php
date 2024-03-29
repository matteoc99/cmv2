<ul id="nav-mobile" class="sidenav">
    <h5 href="#" class="brand-logo center light-green-text">
        @lang("navigation.brandName")
    </h5>

    @if(is_null(Auth::user()))
        <li><a data-value="features" class="scrollto" href="{{route("landing")}}">@lang("navigation.features")</a></li>
        <li><a data-value="pricing" class="scrollto" href="{{route("landing")}}">@lang("navigation.pricing")</a></li>
        <li><a href="{{route("login")}}">@lang("navigation.login")</a></li>
        <li><a href="{{route("register")}}">@lang("navigation.register")</a></li>
    @else
        <li><a href="{{route("logout")}}">@lang("navigation.logout")</a></li>
    @endif
    @include("components.langSelect",["id"=>"langmobile"])

</ul>
<div class="navbar-fixed">

    <nav class="blue darken-4" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" data-value="top"
               class="brand-logo center hide-on-med-and-down hide-on-large-only show-on-extra-large scrollto">
                @lang("navigation.brandName")
            </a>
            <ul class="left hide-on-med-and-down">
                @if(is_null(Auth::user()))
                    <li><a data-value="features" class="scrollto" href="{{route("landing")}}">@lang("navigation.features")</a></li>
                <li><a data-value="pricing" class="scrollto" href="{{route("landing")}}">@lang("navigation.pricing")</a></li>
                @endif
            </ul>
            <ul class="right hide-on-med-and-down">
                @include("components.langSelect",["id"=>"lang"])
                @if(is_null(Auth::user()))
                    <li><a href="{{route("login")}}">@lang("navigation.login")</a></li>
                    <li><a href="{{route("register")}}">@lang("navigation.register")</a></li>
                @else
                    <li><a href="{{route("logout")}}">@lang("navigation.logout")</a></li>
                @endif
            </ul>

            <a href="#!" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
</div>


