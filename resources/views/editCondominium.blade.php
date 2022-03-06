@extends("layouts.dashMaster")

@section("content")
    <div class="container">
        <h3><a href="{{route("dashboard")}}"><i
                    class="material-icons small blue-text text-darken-4">arrow_back</i></a><i
                class="material-icons small">domain</i>{{$condominium->name}}</h3>
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4>@lang("condominium.editTitle")</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('editCondominiumPost',$condominium->id) }}">
                        @csrf
                        <input type="hidden" name="lat" id="lat" value="{{$condominium->lat}}">
                        <input type="hidden" name="lng" id="lng" value="{{$condominium->lng}}">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">home</i>
                                <input class="validate" id="name" type="text" name="name"
                                       value="{{$condominium->name}}">
                                <label for="name" data-error="wrong"
                                       data-success="right">@lang("condominium.name") </label>
                            </div>
                            @if($errors->get("name"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>@lang("condominium.nameMissing") </strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">location_on</i>
                                <input class="validate" id="address" type="text" name="address"
                                       value="{{$condominium->address}}">
                                <label for="address" data-error="wrong"
                                       data-success="right">@lang("condominium.address")  </label>
                            </div>
                            @if($errors->get("address"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>@lang("condominium.addressMissing")</strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        <!--div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">date_range</i>
                                <input id="period" class="datepicker" type="text" name="period"
                                       value="{{$condominium->period}}">
                                <label for="period" data-error="wrong"
                                       data-success="right"> Legal Period </label>
                            </div>
                            @if($errors->get("period"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>The Legal Period is missing </strong>
                                        </span>
                                <br>
                            @endif
                        </div-->
                        <div class="row">
                            <div id="map" style="height: 300px"></div>
                            @if($errors->get("lat"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>@lang("condominium.positionMissing") </strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <button type="submit"
                                        class="btn waves-effect waves-light blue darken-4 col s12"> @lang("condominium.update")
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if(session()->has('success'))
            @include("components.successToast")
        @endif
    </div>
    <script>
        var mapExists = document.getElementById("map");
        if (mapExists !== null) {
            var lat = $("#lat").val();
            var lng = $("#lng").val();
            console.log(lat)
            if (lat == null || lat === "") {
                lat = 46.49067;
                lng = 11.33982;
            }
            var marker;
            var map = L.map('map').setView([lat, lng], 13);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: '',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWF0c3RhIiwiYSI6ImNreWxsZ2FmZzF6OHcyd3AwbDBiNzVhMXAifQ.4dmiRzha7xfW0M0_18oVpA'
            }).addTo(map);
            marker = L.marker([lat, lng]).addTo(map);

            function onMapClick(e) {
                lat = e.latlng.lat;
                lng = e.latlng.lng;
                $("#lat").val(lat)
                $("#lng").val(lng)
                if (marker == null) {
                    marker = L.marker([lat, lng]).addTo(map);
                } else {
                    marker.setLatLng([lat, lng]);
                }
            }

            map.on('click', onMapClick);
        }
    </script>
@endsection
