@extends("layouts.dashMaster ")

@section("content")
    <div class="container">
        <ul class="collapsible">
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
            <li>
                <div class="collapsible-header"><i class="material-icons">insert_drive_file</i>Tickets</div>
                <div class="collapsible-body"></div>
            </li>

        </ul>
    </div>
@endsection
