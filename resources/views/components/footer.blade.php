<footer class="page-footer blue darken-4">
    <div class="container">
        <div class="row">
            <div class="col offset-l1 l6 m8 s12">
                <h5 class="white-text">Condominium Manager</h5>
                <p class="grey-text text-lighten-4 justified">
                    @lang("landing.footerDesc")
                </p>


            </div>
            <div class="col l4 m4 s12">
                <h5 class="white-text">@lang("landing.legal")</h5>
                <ul>
                    <li><a class="white-text " href="{{route("privacy")}}">@lang("landing.privacy")</a></li>
                    <li><a class="white-text " href="{{route("terms")}}">@lang("landing.terms")</a></li>
                    <li><a class="white-text " href="{{route("impressum")}}">@lang("landing.impressum")</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Made by <a class="light-green-text" href="mailto:matteo.cosi@live.it">Matteo Cosi</a>
        </div>
    </div>
</footer>
