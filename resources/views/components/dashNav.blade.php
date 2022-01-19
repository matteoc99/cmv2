<ul id="nav-mobile" class="sidenav">
    <h5 href="#" class="brand-logo center light-green-text">
        Condominium&nbsp;Manager
    </h5>
    <li><a href="{{route("dashboard")}}">Dashboard</a></li>
    @include("components.langSelect")
    <li><a href="{{route("logout")}}">Logout</a></li>
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
                @include("components.langSelect")
                <li><a href="{{route("logout")}}">Logout</a></li>
            </ul>

            <a href="#!" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
</div>
