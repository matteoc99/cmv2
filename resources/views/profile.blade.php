@extends("layouts.dashMaster")

@section("content")
    <div class="container">
        <h3 class="center">{{$name}}</h3>
        <div class="row" style="display: flex; flex: 1">
            <div class="col s12 m6 l4">
                <img class="profile-pic materialboxed" src="{{$img}}">
            </div>
            <div class="col s12 m6 l8" style="align-self: flex-end">
                <p>{{$set->desc}}</p>
                <p>{{$set->first_name}} {{$set->last_name}}</p>
                @if(!is_null($set->address))
                    <p>@lang("profile.address"): {{$set->address}}</p>
                @endif
                @if(!is_null($set->phone))
                    <p>@lang("profile.phone"): {{$set->phone}}</p>
                @endif

                <a href="mailto:{{$user->email}}" class="btn waves-effect waves-light blue darken-4">
                    @lang("profile.contact")
                </a>
            </div>
        </div>
    </div>
@endsection
