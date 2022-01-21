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
                    <li>
                        <div class="collapsible-header"><i class="material-icons">insert_drive_file</i>Tickets</div>
                        <div class="collapsible-body">
                            <div class="row">
                                @foreach($tickets as $ticket)
                                    @include("components.ticketBox",["ticket", $ticket])
                                @endforeach
                            </div>
                        </div>
                    </li>
                @endif


            </ul>
        </div>
    @endif

@endsection
