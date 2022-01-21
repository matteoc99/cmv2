<ul id="dropdown1" class="dropdown-content">
    @if(!App::isLocale('en'))
        <li><a href="{{route("language","en")}}" data-value="en" class="lang-change "><span id="en-switch"
                                                                     class="light-green-text">English</span></a>
        </li>
    @endif
    @if(!App::isLocale('de'))
        <li><a href="{{route("language","de")}}" data-value="de" class="lang-change "><span id="de-switch"
                                                                     class="light-green-text">Deutsch</span></a>
        </li>
    @endif
    @if(!App::isLocale('it'))
        <li><a href="{{route("language","it")}}" data-value="it" class="lang-change "><span id="it-switch"
                                                                     class="light-green-text">Italiano</span></a></li>
    @endif

</ul>
<li><a class="dropdown-trigger" href="#!" data-target="dropdown1">@lang("global.currentLang")<i
            class="material-icons right">arrow_drop_down</i></a>
