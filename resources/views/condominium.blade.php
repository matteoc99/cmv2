@extends("layouts.dashMaster ")

@section("content")
    @if(is_countable($families)&&count($families)>0||is_countable($tickets)&&count($tickets)>0)
        <div class="container">
            <ul class="collapsible">
                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                    @if(is_countable($families)&&count($families)>0)
                        <li>
                            <div class="collapsible-header"><i class="material-icons">person</i>Tenants</div>
                            <div class="collapsible-body">
                                <div class="row">
                                    @foreach($families as $family)
                                        @include("components.familyBox",["family", $family])
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endif
                @endif
                @if(is_countable($tickets)&&count($tickets)>0)
                    @foreach(\App\Models\Status::all() as $status)
                        <li>
                            <div class="collapsible-header"><i class="material-icons">insert_drive_file</i>Tickets
                                : {{$status->name()}}</div>
                            <div class="collapsible-body">
                                <div class="row">
                                    @foreach($tickets as $ticket)
                                        @if($ticket->status_id==$status->id)
                                            @include("components.ticketBox",["ticket", $ticket])
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif


            </ul>
        </div>
    @else
        @include("components.fabDiscovery")
    @endif


@endsection
