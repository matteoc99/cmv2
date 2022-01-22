<div class="fixed-action-btn" id="menucontainer">
    <a id="menu" class="btn-floating btn-large blue">
        <i class="large material-icons">add</i>
    </a>

    <ul>
        @if(Request::route()->getName()=="condominium")
            @can("create",\App\Models\Family::class)
                <li><a href="{{route("createFamily",Request::route('condominium')->id)}}"
                       class="btn-floating blue lighten-1"><i class="material-icons">group_add</i></a>
                </li>
            @endcan
        @endif
        @can("create",\App\Models\Condominium::class)
            <li><a href="{{route("createCondominium")}}" class="btn-floating blue lighten-1"><i
                        class="material-icons">home</i></a></li>
        @endcan
        @if(Request::route()->getName()=="condominium")
            @can("create",\App\Models\Ticket::class)
                <li><a href="{{route("createTicket",Request::route('condominium')->id)}}"
                       class="btn-floating blue lighten-1"><i
                            class="material-icons">note_add</i></a></li>
            @endcan
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->isCraftsman())
                <li><a href="#addTicketModal"
                       class="btn-floating blue lighten-1 modal-trigger"><i
                            class="material-icons">note_add</i></a></li>
        @endif
        <li><a href="{{route("support")}}" class="btn-floating blue lighten-1"><i class="material-icons">help</i></a>
        </li>

    </ul>
</div>
