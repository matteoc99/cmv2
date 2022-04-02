<li class="active">
    <div class="collapsible-header">
        <span>{{$condominium->name}} ({{$condominium->address}}) &nbsp; </span>
        <span> @lang("condominium.openTicket"): {{count($condominium->openTickets())}} </span>
        @if(count($condominium->unreadTickets())>0)
            <span> @lang("condominium.newTicket"): {{count($condominium->unreadTickets())}} </span>
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
        <span class="right" style="margin-left: auto">
        <a href="{{route("condominium",$condominium->id)}}">@lang("condominium.manage")</a>
        <a href="{{route("editCondominium",$condominium->id)}}">@lang("condominium.edit")</a>
        </span>
    </div>
    <div class="collapsible-body">
        <div class="row">
            @foreach($condominium->openTickets() as $ticket)
                @include("components.boxes.ticketBox",["ticket"=>$ticket])
            @endforeach

        </div>

    </div>
</li>
