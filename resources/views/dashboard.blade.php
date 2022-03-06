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
                    @if(\Illuminate\Support\Facades\Auth::user()->setting()->condominium_box_view)
                        <a class="waves-effect waves-light btn blue darken-4" href="{{route("setListView")}}">
                            <i class="material-icons ">list</i>
                        </a>
                    @else
                        <a class="waves-effect waves-light btn blue darken-4" href="{{route("setBoxView")}}">
                            <i class="material-icons ">check_box_outline_blank</i>
                        </a>
                    @endif
                </div>

            </div>
            <div class="row">
                @if(\Illuminate\Support\Facades\Auth::user()->setting()->condominium_box_view)
                    @foreach($condominia as $condominium)
                        @include("components.boxes.condominiumBox",["condominium", $condominium])
                    @endforeach
                @else
                    <ul class="collection">
                        @foreach($condominia as $condominium)
                            @include("components.boxes.condominiumListBox",["condominium", $condominium])
                        @endforeach
                    </ul>
                @endif
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
