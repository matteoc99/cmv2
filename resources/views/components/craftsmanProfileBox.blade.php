<div class="row">
    <div class="col s12 xl6">
        <div class="card">
            <div class="row" style="max-height: 250px">
                <div class="col s12 m4">
                    @php
                        $set=$craftsman->setting();
                        $img =asset("uploads/default.jpg");
                       if($set->hasPicture()){
                           $img = asset("uploads/".$set->picture()->uuid.".".$set->picture()->mime_type);
                       }
                    @endphp
                    <img class="profile-pic materialboxed" src="{{$img}}">
                </div>
                <div class="col s12 m8">
                    <h4>{{$set->firm_name}}</h4>
                    <p>{{$set->desc}}</p>
                    <p>{{$set->first_name}} {{$set->last_name}}</p>
                    @if(!is_null($set->address))
                        <p>Adress: {{$set->address}}</p>
                    @endif
                    @if(!is_null($set->phone))
                        <p>Phone: {{$set->phone}}</p>
                    @endif

                    <a href="{{route("addCraftsmanToTicket",[$ticket_id,$craftsman->id])}}" class="btn waves-effect waves-light blue darken-4">
                        Add Craftsman to Ticket
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
