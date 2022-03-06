<div class="row">
    <div class="col s12 xl6">
        <div class="card">
            <div class="row" style="max-height: 250px; padding: 25px">
                <div class="col s12 m4">

                    <img class="profile-pic materialboxed" src="{{$craftsman->profilePicture()}}">
                </div>
                <div class="col s12 m8">
                    <h4>{{$craftsman->setting()->firm_name}}</h4>
                    <p>{{$craftsman->setting()->desc}}</p>
                    <p>{{$craftsman->setting()->first_name}} {{$craftsman->setting()->last_name}}</p>
                    @if(!is_null($craftsman->setting()->address))
                        <p>@lang("profile.address"): {{$craftsman->setting()->address}}</p>
                    @endif
                    @if(!is_null($craftsman->setting()->phone))
                        <p>@lang("profile.phone"): {{$craftsman->setting()->phone}}</p>
                    @endif

                    <a href="{{route("addCraftsmanToTicket",[$ticket_id,$craftsman->id])}}" class="btn waves-effect waves-light blue darken-4">
                        @lang("profile.addCraftsman")
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
