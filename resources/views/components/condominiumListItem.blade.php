<li class="collection-item">
    <span>{{$condominium->name}} ({{$condominium->address}})</span> Ticket: {{count($condominium->tickets()->get())}}
    @if(count($condominium->unreadTickets())>0)
        <span class="new badge">{{count($condominium->unreadTickets())}}</span>
    @endif
    @php
        $unreadMessages = 0;
        foreach ($condominium->tickets()->get() as $ticket){
            $unreadMessages=$unreadMessages+count($ticket->unreadChatMessages());
        }
    @endphp
    @if($unreadMessages > 0)
        <span>New Messages: {{$unreadMessages}}</span>
    @endif
    <span class="right">
        <a href="{{route("condominium",$condominium->id)}}">Manage</a>
        <a href="{{route("editCondominium",$condominium->id)}}">Edit</a>
    </span>
</li>

