<li class="collection-item">
    <span>{{$condominium->name}} ({{$condominium->address}})</span>
    @if(count($condominium->unreadTickets())>0)
        <span>@lang("condominium.newTicket"): {{count($condominium->unreadTickets())}} </span>
    @endif
    @php
        $unreadMessages = 0;
        foreach ($condominium->tickets()->get() as $ticket){
            $unreadMessages=$unreadMessages+count($ticket->unreadChatMessages());
        }
    @endphp
    @if($unreadMessages > 0)
        <span>@lang("condominium.newMessage"): {{$unreadMessages}}</span>
    @endif
    <span class="right">
        <a href="{{route("condominium",$condominium->id)}}">@lang("condominium.manage")</a>
        <a href="{{route("editCondominium",$condominium->id)}}">@lang("condominium.edit")</a>
    </span>
</li>

