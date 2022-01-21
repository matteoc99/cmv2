
@extends("layouts.dashMaster ")

@section("content")

    <div class="container">
        <div class="row">
        </div>
        <div class="row">
        <div class="col s12 m12 l6 xl6 offset-l3 offset-xl3">
            <div class="card blue darken-4">
                <div class="card-content white-text">
                    <span class="card-title">{{$ticket->title}}</span>
                    <p>{{$ticket->desc}}</p>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
