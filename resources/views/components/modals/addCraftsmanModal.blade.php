<!-- Modal Structure -->
<div id="addCraftsmanModal" class="modal">
    <div class="modal-content">
        <h4 class="center">@lang("modals.addACraftsman")</h4>
        @php
        $empty=true;
            @endphp
        @foreach(\App\Models\User::all()->where("role_id","=",3) as $craftsman)
            @if($craftsman->hasTag(Request::route('ticket')->tag_id))
                @php
                    $empty=false;
                @endphp
                @include("components.boxes.craftsmanProfileBox",["craftsman"=>$craftsman,"ticket_id"=>Request::route('ticket')->id])
            @endif
        @endforeach
        @if($empty)
            <div class="center">
                <p>@lang("modals.noCraftsmanRegistered"):{{Request::route('ticket')->tag()->name()}} <br>
                    @lang("modals.generateLinkPrompt")</p>
            </div>
        @endif
    </div>
</div>
