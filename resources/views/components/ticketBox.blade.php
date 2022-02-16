<div class="col s12 m6 l4 xl3">
    <div class="card blue darken-4">
        <div class="card-content white-text">
            <span class="card-title">{{$ticket->title}}</span>
            <p>{{$ticket->desc}}</p>
            <p>{{$ticket->urgency()->name()}}</p>
            @if($ticket->hasStatus())
                <p>{{$ticket->status()->get()->first()->name()}}</p>
            @endif
            <p>{{$ticket->tag()->name()}}</p>
            <p>New Messages: {{count($ticket->unreadChatMessages())}}</p>
        </div>
        @can("view",$ticket)
            <div class="card-action">
                <a href="{{route("ticket",$ticket->id)}}">Manage</a>
            </div>
        @endcan
    </div>
</div>
