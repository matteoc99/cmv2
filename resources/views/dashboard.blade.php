@extends("layouts.dashMaster")

@section("content")
    <div class="container">
        @if(is_countable($condominia)&&count($condominia)>0)
            <div class="row">
                <div class="input-field col s12">
                </div>
                <div class="input-field col s12 m6 l4 xl3">
                    <i class="material-icons prefix">search</i>
                    <input id="search" type="text" class="validate">
                    <label for="search">@lang("dashboard.search")</label>
                </div>
                <div class="input-field col s12 m6 l4 xl3 ">
                    @switch(\Illuminate\Support\Facades\Auth::user()->setting()->condominium_box_view)
                        @case(0)
                        <a class="waves-effect waves-light btn blue darken-4" href="{{route("setBoxView")}}">
                            <i class="material-icons ">check_box_outline_blank</i>
                        </a>
                        @break
                        @case(1)
                        <a class="waves-effect waves-light btn blue darken-4" href="{{route("setTicketView")}}">
                            <i class="material-icons ">assignment</i>
                        </a>
                        @break
                        @case(2)
                        <a class="waves-effect waves-light btn blue darken-4" href="{{route("setListView")}}">
                            <i class="material-icons ">list</i>
                        </a>
                        @break
                    @endswitch
                </div>

            </div>
            <div class="row">
                @switch(\Illuminate\Support\Facades\Auth::user()->setting()->condominium_box_view)
                    @case(0)
                    <ul class="collection">
                        @foreach($condominia as $condominium)
                            @include("components.boxes.condominiumListBox",["condominium", $condominium])
                        @endforeach
                    </ul>
                    @break
                    @case(1)
                        @foreach($condominia as $condominium)
                            @include("components.boxes.condominiumBox",["condominium", $condominium])
                        @endforeach
                    @break
                    @case(2)
                    <ul class="collapsible">
                        @foreach($condominia as $condominium)
                            @if($condominium->hasOpenTickets())
                                @include("components.boxes.condominiumTicket",["condominium", $condominium])
                            @endif
                        @endforeach
                    </ul>

                    @break
                @endswitch


            </div>
        @else
            @include("components.fabDiscovery")
        @endif
    </div>
    <script>
        $(document).ready(function () {
            document.getElementById("search").addEventListener('input', (event) => {
                val = event.target.value;
                $(".condominium-box").each(function (i, obj) {
                    if ($(obj).data("search").toLowerCase().search(val.toLowerCase()) >= 0) {
                        $(obj).show();
                    } else {
                        $(obj).hide();
                    }
                });
            });
        });

    </script>
@endsection
