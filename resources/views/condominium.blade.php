@extends("layouts.dashMaster ")

@section("content")
    <div class="container">


        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <h3><a href="{{route("dashboard")}}"><i
                        class="material-icons small blue-text text-darken-4">arrow_back</i></a><i
                    class="material-icons small">domain</i>{{$condominium->name}}</h3>
            <a class="btn waves-effect waves-light blue darken-4 col s12 m6 l3"
               href="{{route("exportToExcel",$condominium->id)}}">@lang("condominium.toExcel")</a>
        @else
            @if(!is_null($condominium))
                <h3><i class="material-icons small">domain</i>{{$condominium->name}}</h3>
            @endif
        @endif
        @if(!is_null($condominium))
            <a class="btn waves-effect waves-light blue darken-4 col s12 m6 l3"
               href="{{route("documents",$condominium->id)}}">@lang("condominium.documents")</a>
        @endif
        @if((\Illuminate\Support\Facades\Auth::user()->isAdmin()&&is_countable($families)&&count($families)>0)||is_countable($tickets)&&count($tickets)>0)
            <ul class="collapsible">
                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                    @if(is_countable($families)&&count($families)>0)
                        <li>
                            <div class="collapsible-header"><i class="material-icons">person</i>@lang("condominium.tenants")
                                <span class="badge">{{count($families)}}</span>
                            </div>
                            <div class="collapsible-body">
                                <div class="row">
                                    @foreach($families as $family)
                                        @include("components.boxes.familyBox",["family"=>$family,"condominium"=>$condominium])
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endif
                @endif
                @php
                    $openFirst=true;
                @endphp
                @if(is_countable($tickets)&&count($tickets)>0)
                    @foreach(\App\Models\Status::all() as $status)
                        @php
                            $ticketsByStatus=$tickets->where("status_id","=",$status->id);
                            $anyNew=false;
                            foreach ($tickets as $ticket){
                                if($ticket->isNew()){
                                    $anyNew=true;
                                    $userticket = new \App\Models\UserTickets();
                                    $userticket->user_id=\Illuminate\Support\Facades\Auth::user()->id;
                                    $userticket->ticket_id=$ticket->id;
                                    $userticket->seen = true;
                                    $userticket->save();
                                }
                            }
                        @endphp
                        @if(is_countable($ticketsByStatus)&&count($ticketsByStatus)>=1)
                            <li class="{{$openFirst?"active":""}}">
                                @php
                                    $openFirst=false;
                                @endphp
                                <div class="collapsible-header"><i class="material-icons">insert_drive_file</i>@lang("condominium.tickets")
                                    : {{$status->name()}}
                                    <span
                                        class="{{$anyNew?"new blue darken-4" : ""}} badge">{{count($ticketsByStatus)}}</span>
                                </div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        @foreach($tickets as $ticket)
                                            @if($ticket->status_id==$status->id)
                                                @include("components.boxes.ticketBox",["ticket", $ticket])
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        @endif

                    @endforeach
                @endif
            </ul>
        @else
            @include("components.fabDiscovery")
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->isCraftsman())
            @include("components.ticketMap")
        @endif
    </div>


@endsection
