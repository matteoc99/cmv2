@extends("layouts.dashMaster ")

@section("content")

    <div class="container">
        @auth
            <h3><a href="{{route("condominium",$ticket->condominium()->id)}}"><i
                        class="material-icons small blue-text darken-4">arrow_back</i></a><i
                    class="material-icons small">domain</i>{{$ticket->condominium()->name}} : {{$ticket->title}}</h3>
        @endauth
        <div class="row">
            <div class="col s12 m12 l6 xl6">
                <div class="card ">
                    <div class="card-content ">
                        <span class="card-title">{{$ticket->title}}</span>
                        <p>{{$ticket->desc}}</p>
                        <p>Status: {{$ticket->status()->name()}}</p>
                        <p>Urgency: {{$ticket->urgency()->name()}}</p>
                        <p>Work type: {{$ticket->tag()->name()}}</p>
                        @if(!is_null($ticket->craftsman_id))
                            <a class="btn waves-effect waves-light blue darken-4"
                               href="{{route("profile",$ticket->craftsman_id)}}">Craftsman Profile</a>
                        @endif
                    </div>
                    @can("createToken",$ticket)
                        <div class="card-action">
                            @if(is_null($ticket->token))
                                <a class="btn waves-effect waves-light blue darken-4"
                                   href="{{route("generateTicketToken",$ticket->id)}}">Generate Access Link</a>
                            @else
                                <p style="overflow-wrap: break-word;"> {{route("ticketByToken",$ticket->token)}}</p>
                                <a class="btn waves-effect waves-light blue darken-4"
                                   href="{{route("generateTicketToken",$ticket->id)}}">Generate new Access Link</a>
                            @endif
                            <a href="#addCraftsmanModal"
                               class="modal-trigger btn waves-effect waves-light blue darken-4"><i
                                    class="material-icons">contacts</i></a>
                        </div>
                    @endcan
                </div>
                @if(!is_null(\Illuminate\Support\Facades\Auth::user()))
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
                                            <option
                                                value="{{$status->id}}" {{$ticket->status_id==$status->id?"selected":""}}>{{$status->name()}}</option>
                                        @endforeach
                                    </select>
                                    <label>Status</label>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="input-field col s12">
                                    <select name="urgency">
                                        @foreach(\App\Models\Urgency::all() as $urgency)
                                            <option
                                                value="{{$urgency->id}}" {{$ticket->urgency_id==$urgency->id?"selected":""}}>{{$urgency->name()}}</option>
                                        @endforeach
                                    </select>
                                    <label>Urgency</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <select name="tag">
                                        @foreach(\App\Models\Tag::all() as $tag)
                                            <option
                                                value="{{$tag->id}}" {{$ticket->tag_id==$tag->id?"selected":""}}>{{$tag->name()}}</option>
                                        @endforeach
                                    </select>
                                    <label>Work Type</label>
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
                @endif
            </div>
            @if(!is_null(\Illuminate\Support\Facades\Auth::user()))
                <div class="col s12 m12 l6 xl6 card chat-container">
                    <h3 class="center">Chat</h3>

                    @livewire("chat",["chat"=>$ticket->chat()])
                    <div>
                        <form method="POST" action="{{ route('sendMessage',$ticket->chat()->id) }}">
                            @csrf
                            <div class="input-field col s8">
                                <input class="validate" id="message" type="text" name="message">
                                <label for="message" data-error="wrong"
                                       data-success="right"> Chat Message</label>
                            </div>
                            <div class="input-field col s4">
                                <button type="submit" id="submit"
                                        class="btn waves-effect waves-light blue darken-4 col s12"><i
                                        class="material-icons">send</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="col s12 m12 l6 xl6 card chat-container">
                    @include("auth.components.registerForm",["selected"=>3])
                </div>
            @endif
        </div>
        <div class="row">
            @if(session()->has('success'))
                @include("components.successToast")
            @endif
        </div>
        @if(!is_null(\Illuminate\Support\Facades\Auth::user())&&\Illuminate\Support\Facades\Auth::user()->isAdmin())
            @include("components.addCraftsmanModal")
        @endif
    </div>
@endsection
