<div class="fixed-action-btn" id="menucontainer">
    <a id="menu" class="btn-floating btn-large blue darken-4">
        <i class="large material-icons">add</i>
    </a>

    <ul>
        @if(Request::route()->getName()=="condominium")
            @can("create",\App\Models\Family::class)
                <li><a href="{{route("createFamily",Request::route('condominium')->id)}}"
                       class="btn-floating blue  darken-4"><i class="material-icons">group_add</i></a>
                </li>
            @endcan
            @cannot("create",\App\Models\Family::class)
                <li><a href="#upgradeCallModal" class="modal-trigger btn-floating blue  darken-4"><i
                            class="material-icons">group_add</i></a></li>
            @endcannot
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            @can("create",\App\Models\Condominium::class)
                <li><a href="{{route("createCondominium")}}" class="btn-floating blue  darken-4"><i
                            class="material-icons">home</i></a></li>

            @endcan
            @cannot("create",\App\Models\Condominium::class)
                <li><a href="#upgradeCallModal" class="modal-trigger btn-floating blue  darken-4"><i
                            class="material-icons">home</i></a></li>
            @endcannot
        @endif
        @if(Request::route()->getName()=="condominium")
            @can("create",\App\Models\Ticket::class)
                <li><a href="{{route("createTicket",Request::route('condominium')->id)}}"
                       class="btn-floating blue  darken-4"><i
                            class="material-icons">assignment</i></a></li>
            @endcan
            @cannot("create",\App\Models\Ticket::class)
                <li><a href="#upgradeCallModal" class="modal-trigger btn-floating blue  darken-4"><i
                            class="material-icons">assignment</i></a></li>
            @endcannot
        @endif
        @if((Request::route()->getName()=="documents"||Request::route()->getName()=="folder")&&\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <li><a href="#addFolderModal"
                   class="modal-trigger btn-floating blue  darken-4"><i
                        class="material-icons">create_new_folder</i></a></li>
            @can("createDocument",\App\Models\Document::class)
                <li><a href="#addDocumentModal"
                       class="modal-trigger btn-floating blue  darken-4"><i
                            class="material-icons">note_add</i></a></li>
            @endcan
            @cannot("createDocument",\App\Models\Document::class)
                <li><a href="#upgradeCallModal" class="modal-trigger btn-floating blue  darken-4"><i
                            class="material-icons">note_add</i></a></li>
            @endcannot

        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->isCraftsman())
            <li><a href="#addTicketModal"
                   class="btn-floating blue  darken-4 modal-trigger"><i
                        class="material-icons">note_add</i></a></li>
        @endif
        <li><a href="mailto:matteo.cosi@live.it" class="btn-floating blue  darken-4"><i class="material-icons">help</i></a>
        </li>

    </ul>
</div>
