<!-- Modal Structure -->
<div id="addCraftsmanModal" class="modal">
    <div class="modal-content">
        <h4>Add A craftsman</h4>
        @foreach(\App\Models\User::all()->where("role_id","=",3) as $craftsman)
            @if($craftsman->hasTag(Request::route('ticket')->tag_id))
                @include("components.craftsmanProfileBox",["craftsman"=>$craftsman,"ticket_id"=>Request::route('ticket')->id])
            @endif
        @endforeach
    </div>
</div>
