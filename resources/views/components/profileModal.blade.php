<div id="profileModal" class="modal">
    <div class="modal-content">
        <h3 class="center">{{$user->name()}}</h3>
        <div class="row" style="display: flex; flex: 1">
            <div class="col s12 m6 l4">
                <img class="profile-pic materialboxed" src="{{$user->profilePicture()}}">
            </div>
            <div class="col s12 m6 l8" style="align-self: flex-end">
                @if(!is_null($user->setting()->first_name) && !is_null($user->setting()->last_name))
                    <p>{{$user->setting()->first_name}} {{$user->setting()->last_name}}</p>
                @endif
                @if(!is_null($user->setting()->address))
                    <p>{{$user->setting()->desc}}</p>
                @endif
                @if(!is_null($user->setting()->address))
                    <p>Adress: {{$user->setting()->address}}</p>
                @endif
                @if(!is_null($user->setting()->phone))
                    <p>Phone: {{$user->setting()->phone}}</p>
                @endif

                @if(\Illuminate\Support\Facades\Auth::user()->id != $user->id)
                    <a href="mailto:{{$user->email}}" class="btn waves-effect waves-light blue darken-4">
                        Contact via E-Mail
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
