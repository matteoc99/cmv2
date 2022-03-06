<div class="col s12 m6 l4 xl3 condominium-box" data-search="{{$condominium->name}}">
    <div class="card blue darken-4">
        <div class="card-content white-text">
            <span class="card-title">{{$condominium->name}}</span>
            <p>{{$condominium->address}}</p>
            <p>{{$condominium->period}}</p>
            <p>@lang("condominium.ticket"): {{count($condominium->tickets()->get())}}
                @if(count($condominium->unreadTickets())>0)
                    <span class="new badge">{{count($condominium->unreadTickets())}}</span>
                @endif
            </p>
            @php
                $unreadMessages = 0;
                foreach ($condominium->tickets()->get() as $ticket){
                    $unreadMessages=$unreadMessages+count($ticket->unreadChatMessages());
                }
            @endphp
            @if($unreadMessages > 0)
                <p>@lang("condominium.newMessage"): {{$unreadMessages}}</p>
            @endif
        </div>
        <div class="card-action">
            <a href="{{route("condominium",$condominium->id)}}">@lang("condominium.manage")</a>
            <a href="{{route("editCondominium",$condominium->id)}}" class="right">@lang("condominium.edit")</a>
        </div>
    </div>
</div>
