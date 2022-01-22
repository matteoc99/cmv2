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
                    @can("createToken",$ticket)
                        @if(is_null($ticket->token))
                            <div class="card-action">
                                <a href="{{route("generateTicketToken",$ticket->id)}}">Generate Access Link</a>
                            </div>
                        @else
                            <div class="card-action">
                                <p style="overflow-wrap: break-word;"> {{route("ticketByToken",$ticket->token)}}</p>
                                <a href="{{route("generateTicketToken",$ticket->id)}}">Generate new Access Link</a>
                            </div>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
