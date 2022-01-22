@extends("layouts.dashMaster ")

@section("content")

    <div class="container">
        <div class="row">
        </div>
        <div class="row">
            <div class="col s12 m12 l6 xl6 offset-l3 offset-xl3">
                <div class="card ">
                    <div class="card-content ">
                        <span class="card-title">{{$ticket->title}}</span>
                        <p>{{$ticket->desc}}</p>
                        @if(!is_null($ticket->craftsman_id))
                            <a href="{{route("profile",$ticket->craftsman_id)}}">Craftsman Profile</a>
                        @endif
                        <p>Status: {{$ticket->status()->name()}}</p>
                        <p>Urgency: {{$ticket->urgency()->name()}}</p>
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
                <form method="POST" action="{{ route('updateTicketPost',$ticket->id) }}">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="validate" id="title" type="text" name="title" value="{{$ticket->title}}">
                            <label for="title" data-error="wrong"
                                   data-success="right"> Title </label>
                        </div>
                        @if($errors->get("title"))
                            <span class="invalid-feedback" role="alert">
                                            <strong>The Title is missing </strong>
                                        </span>
                            <br>
                        @endif
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="validate" id="desc" type="text" name="desc" value="{{$ticket->desc}}">
                            <label for="desc" data-error="wrong"
                                   data-success="right"> Description</label>
                        </div>
                        @if($errors->get("desc"))
                            <span class="invalid-feedback" role="alert">
                                            <strong>The Description is missing </strong>
                                        </span>
                            <br>
                        @endif
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->isCraftsman())
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="status">
                                @foreach(\App\Models\Status::all() as $status)
                                    <option value="{{$status->id}}" {{$ticket->status_id==$status->id?"selected":""}}>{{$status->name()}}</option>
                                @endforeach
                            </select>
                            <label>Status</label>
                        </div>
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
        <div class="row">
            @if(session()->has('success'))
                @include("components.successToast")
            @endif
        </div>
    </div>
@endsection
