<div id="upgradeCallModal" class="modal">
    <div class="modal-content">
        <h4 class="center">@lang("modals.youNeedToUpgrade")</h4>
        <div class="row">
            <div class="input-field col s12 m6 offset-m3">
               @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                <a href="{{route("settings.subscribe")}}"
                        class="btn waves-effect waves-light blue darken-4 col s12">@lang("modals.upgradeNow")</a>
                @else
                    <a id="mailtoadmin"
                       class="btn waves-effect waves-light blue darken-4 col s12">@lang("modals.upgradeNowUser")</a>
                @endif
            </div>
        </div>
    </div>
</div>
