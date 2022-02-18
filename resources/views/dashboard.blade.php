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
                    <label for="search">Search</label>
                </div>
            </div>
            <div class="row">
                @foreach($condominia as $condominium)
                    @include("components.condominiumBox",["condominium", $condominium])
                @endforeach
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
                    if ($(obj).data("search").toLowerCase().search(val.toLowerCase())>=0) {
                        $(obj).show();
                    }else{
                        $(obj).hide();
                    }
                });
            });
        });

    </script>
@endsection
