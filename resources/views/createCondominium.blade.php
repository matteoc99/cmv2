@extends("layouts.dashMaster")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4>Header</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('createCondominium') }}">
                        @csrf
                        <input type="hidden" name="lat" id="lat" value="">
                        <input type="hidden" name="lng" id="lng" value="">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">home</i>
                                <input class="validate" id="name" type="text" name="name">
                                <label for="name" data-error="wrong"
                                       data-success="right"> Name </label>
                            </div>
                            @if($errors->get("name"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>The Name is missing </strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">location_on</i>
                                <input class="validate" id="address" type="text" name="address">
                                <label for="name" data-error="wrong"
                                       data-success="right"> Address </label>
                            </div>
                            @if($errors->get("address"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>The Address is missing </strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        <div class="row">
                            <div id="map" style="height: 300px"></div>
                            @if($errors->get("lat"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>The Position is missing </strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <button type="submit"
                                        class="btn waves-effect waves-light blue darken-4 col s12"> Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var lat;
        var lng;
        var marker;
        var map = L.map('map').setView([46.49067, 11.33982], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWF0c3RhIiwiYSI6ImNreWxsZ2FmZzF6OHcyd3AwbDBiNzVhMXAifQ.4dmiRzha7xfW0M0_18oVpA'
        }).addTo(map);

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
    </script>
@endsection
