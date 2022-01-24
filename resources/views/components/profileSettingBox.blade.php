<div class="row">
    <div class="col s12 m12 l8 xl6 card offset-l2 offset-xl3">
        <div class="card-header center"><h4>Profile</h4></div>
        <div class="card-body">

            <form method="POST" action="{{ route('updateSettings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row" style="display: flex; flex: 1">
                    <div class="input-field col s4 ">
                        <img class="materialboxed" width="100%" src="{{$img}}">
                    </div>
                    <div class="input-field col s8" style="align-self: flex-end">
                        <button type="button" class="btn waves-effect waves-light blue darken-4"
                                onclick="document.getElementById('profile_image').click()">Change Profile
                            Picture
                        </button>
                        <input type='file' name="profile_image" id="profile_image" style="display:none"
                               onchange="document.getElementById('submit').click()">
                    </div>
                    @foreach($errors->get("profile_image") as $error)
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$error}}</strong>
                                        </span>
                        <br>
                    @endforeach
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->isCraftsman())
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="validate" id="firm_name" type="text" name="firm_name"
                                   value="{{$setting->firm_name}}">
                            <label for="firm_name" data-error="wrong"
                                   data-success="right"> Firm Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="validate" id="phone" type="text" name="phone"
                                   value="{{$setting->phone}}">
                            <label for="phone" data-error="wrong"
                                   data-success="right"> Phone</label>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <select name="tags[]" multiple>
                            @foreach(\App\Models\Tag::all() as $tag)
                                @php
                                    $selected =(is_countable(\Illuminate\Support\Facades\Auth::user()->userTags()->where("id","=",$tag->id)->get())
                                    &&count(\Illuminate\Support\Facades\Auth::user()->userTags()->where("id","=",$tag->id)->get())>=1 )
                                @endphp
                                <option value="{{$tag->id}}" {{$selected?"selected":""}}>{{$tag->name()}}</option>
                            @endforeach
                        </select>
                        <label>Tags</label>
                    </div>
                @endif
                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="first_name" type="text" name="first_name"
                               value="{{$setting->first_name}}">
                        <label for="first_name" data-error="wrong"
                               data-success="right"> First Name </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="last_name" type="text" name="last_name"
                               value="{{$setting->last_name}}">
                        <label for="last_name" data-error="wrong"
                               data-success="right"> Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="desc" type="text" name="desc"
                               value="{{$setting->desc}}">
                        <label for="desc" data-error="wrong"
                               data-success="right"> Description</label>
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->isCraftsman()||\Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="validate" id="address" type="text" name="address"
                                   value="{{$setting->address}}">
                            <label for="address" data-error="wrong"
                                   data-success="right"> Address</label>
                        </div>
                    </div>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->isCraftsman())
                    <div class="row">
                        <input type="hidden" name="lat" id="lat" value="{{$setting->lat}}">
                        <input type="hidden" name="lng" id="lng" value="{{$setting->lng}}">
                        <div id="map" style="height: 300px"></div>
                    </div>
                @endif

                <div class="row">
                    <div class="input-field col s12 m6 offset-m3">
                        <button type="submit" id="submit"
                                class="btn waves-effect waves-light blue darken-4 col s12"> Update
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var mapExists = document.getElementById("map");
    if(mapExists!==null) {
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
