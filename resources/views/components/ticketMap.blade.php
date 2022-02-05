<div class="row">
    <div id="map" style="height: 500px"></div>
</div>

<script>
    function onMarkerClick(id){
        alert(id);
    }

    var mapExists = document.getElementById("map");
    if (mapExists !== null) {
        var lat = {{\Illuminate\Support\Facades\Auth::user()->setting()->lat ?? "null"}};
        var lng = {{\Illuminate\Support\Facades\Auth::user()->setting()->lng ?? "null"}};
        if (lat == null || lat === "") {
            lat = 46.49067;
            lng = 11.33982;
        }
        var map = L.map('map').setView([lat, lng], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: '',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWF0c3RhIiwiYSI6ImNreWxsZ2FmZzF6OHcyd3AwbDBiNzVhMXAifQ.4dmiRzha7xfW0M0_18oVpA'
        }).addTo(map);
        var markers = L.markerClusterGroup();

        @foreach(\App\Models\Ticket::where("status_id","<",3)->where("contract_type_id","=",3)->where("craftsman_id","!=",\Illuminate\Support\Facades\Auth::user()->id)->get() as $ticket)
        @php
            $condominium = $ticket->condominium();
            $lat= $condominium->lat;
            $lng= $condominium->lng;
        @endphp
        var marker = L.marker([{{$lat}}, {{$lng}}]);
        marker.bindPopup("{{$ticket->title}}<br>{{$ticket->desc}}<br> <a href='{{route("ticket",$ticket->id)}}' class='btn waves-effect waves-light blue darken-4 white-text'> Create Estimate </>")
        markers.addLayer(marker);
        @endforeach
        map.addLayer(markers);
    }
</script>
