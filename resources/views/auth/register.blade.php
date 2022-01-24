@extends("layouts.AuthMaster")

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
              @include("auth.components.registerForm",["selected"=>2])
            </div>
        </div>
    </div>
@endsection
