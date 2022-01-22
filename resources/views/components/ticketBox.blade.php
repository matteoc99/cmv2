<div class="col s12 m6 l4 xl3">
    <div class="card blue darken-4">
        <div class="card-content white-text">
            <span class="card-title">{{$ticket->title}}</span>
            <p>{{$ticket->desc}}</p>
            <p>{{$ticket->urgency()->name()}}</p>
            @if($ticket->hasStatus())
                <p>{{$ticket->status()->name()}}</p>
            @endif
            <p>{{$ticket->tag()->name()}}</p>
        </div>
        @can("view",$ticket)
            <div class="card-action">
                <a href="{{route("ticket",$ticket->id)}}">Manage</a>
            </div>
        @endcan
    </div>
</div>
