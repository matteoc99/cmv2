<!-- Modal Structure -->
<div id="cookie-modal" class="modal cookie-modal bottom-sheet">
    <div class="container">
        <div class="modal-content">
           <div class="row" style=" display: flex;     align-items: flex-end;">
               <div class="col s10" style=" flex: 5;">
                   <h4>Cookies</h4>
                   <p>
                   @lang("cookies.using")
                   <p>
                       @lang("cookies.declaration")<a
                           href="{{route("privacy")}}">@lang("terms.privacy")</a></p>
               </div>
               <div class="col s2" style=" flex: 1;">
                   <form method="post" action="{{route("cookie_agree")}}">
                       @csrf
                       <button type="submit" class="modal-close waves-effect waves-green btn-flat">Ok</button>
                   </form>
               </div>
           </div>
        </div>
    </div>
</div>
<?php $name = Illuminate\Support\Facades\Route::currentRouteName(); ?>
@if(!\Illuminate\Support\Facades\Session::has("cookie_shown") && !($name == "privacy" ||$name == "terms"))
    <script>
        window.onload = function () {
            waitForJQuery();
        }
    </script>
@endif
