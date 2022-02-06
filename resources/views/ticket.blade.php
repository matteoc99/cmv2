@extends("layouts.dashMaster ")

@section("content")

    <div class="container">
        @auth
            <h3><a href="{{route("condominium",$ticket->condominium()->id)}}"><i
                        class="material-icons small blue-text text-darken-4">arrow_back</i></a><i
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
                        @if(!is_null($ticket->contract_type_id))
                            <p>Contract type: {{$ticket->contractType()->name()}}</p>
                        @endif
                        @if(!is_null($ticket->price()))
                            <p>Price: {{$ticket->price()}}</p>
                        @endif
                        @if(!is_null($ticket->craftsman_id))
                            <a class=" modal-trigger btn waves-effect waves-light blue darken-4"
                               href="#profileModal">Craftsman Profile</a>
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
                                <a class="btn waves-effect waves-light blue darken-4"
                                   href="#" onclick="copyToClipboard('{{route("ticketByToken",$ticket->token)}}')">
                                    <i class="material-icons">content_copy</i>
                                </a>
                            @endif
                            <a href="#addCraftsmanModal"
                               class="modal-trigger btn waves-effect waves-light blue darken-4">Add A Craftsman</a>
                        </div>
                    @endcan
                    @can("createEstimate",$ticket)
                        <div class="card-action">
                            @if(!is_null($ticket->estimateByUserId(\Illuminate\Support\Facades\Auth::user()->id)))
                                @if($ticket->hasApprovedEstimate())
                                    @if($ticket->approvedEstimate()->user_id===\Illuminate\Support\Facades\Auth::user()->id)
                                        <p class="blue-text text-darken-4">Your Estimate has been Approved</p>
                                    @else
                                        <p class="blue-text text-darken-4">Your Estimate has been Declined</p>
                                    @endif
                                @else
                                    @include("components.estimateBox",["estimate"=>$ticket->estimateByUserId(\Illuminate\Support\Facades\Auth::user()->id)])
                                    <p class="blue-text text-darken-4">Pending approval</p>
                                @endif
                            @else
                                <a href="#createEstimateModal"
                                   class="modal-trigger btn waves-effect waves-light blue darken-4">Create Estimate</a>
                            @endif
                        </div>
                    @endcan
                    @can("markAsInProgress",$ticket)
                        <div class="card-action">
                            <a class="btn waves-effect waves-light blue darken-4"
                               href="{{route("ticketMarkAsInProgress",$ticket->id)}}">Start Working on this Ticket</a>
                        </div>
                    @endcan
                    @can("completeTicket",$ticket)
                        <div class="card-action">
                            <a href="{{route("ticket.complete",$ticket->id)}}"
                               class="modal-trigger btn waves-effect waves-light blue darken-4">Mark as Completed</a>
                        </div>
                    @endcan
                    @if($ticket->hasApprovedEstimate())
                        <div class="card-action">
                            @include("components.estimateBox",["estimate"=>$ticket->approvedEstimate()])
                        </div>

                    @else
                        @can("approveEstimates",$ticket)

                            @if(is_countable($ticket->estimates()->get())&&count($ticket->estimates()->get())>0)
                                <div class="card-action">
                                    <a href="#approveEstimatesModal"
                                       class="modal-trigger btn waves-effect waves-light blue darken-4">Approve
                                        Estimates</a>
                                </div>
                            @endif
                        @endcan
                    @endif
                </div>
                @if(!is_null(\Illuminate\Support\Facades\Auth::user()))
                    @if(!\Illuminate\Support\Facades\Auth::user()->isCraftsman())
                        <form method="POST" action="{{ route('updateTicketPost',$ticket->id) }}">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <input class="validate" id="title" type="text" name="title"
                                           value="{{$ticket->title}}">
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
                            @can("changeContractType",$ticket)
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="contractType" id="contractType" onchange="togglePriceContainer()">
                                            @foreach(\App\Models\ContractType::all() as $contractType)
                                                <option
                                                    value="{{$contractType->id}}" {{$ticket->contract_type_id==$contractType->id?"selected":""}}>{{$contractType->name()}}</option>
                                            @endforeach
                                        </select>
                                        <label>Contract Type</label>
                                    </div>
                                </div>
                                <div class="row"
                                     id="price-container" {!!  $ticket->contract_type_id !== 2 ? 'style="display:none"':"" !!}>
                                    <div class="input-field col s12">
                                        <input class="validate" id="price" type="text" name="price"
                                               value="{{$ticket->price()}}">
                                        <label for="price" data-error="wrong"
                                               data-success="right"> Price</label>
                                    </div>
                                </div>
                            @endcan
                            @if(\Illuminate\Support\Facades\Auth::user()->isCraftsman())
                            <!-- <div class="row">
                                <div class="input-field col s12">
                                    <select name="status">
                                        @foreach(\App\Models\Status::all() as $status)
                                <option
                                    value="{{$status->id}}" {{$ticket->status_id==$status->id?"selected":""}}>{{$status->name()}}</option>
                                        @endforeach
                                </select>
                                <label>Status</label>
                            </div>
                        </div-->
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
                                    <button type="submit" id="submitForm"
                                            class="btn waves-effect waves-light blue darken-4 col s12"> Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                @endif
            </div>
            @can("chat",$ticket)
                <div class="col s12 m12 l6 xl6 card chat-container">
                    <h3 class="center">Chat</h3>

                    @livewire("chat",["chat"=>$ticket->chat()])
                    <div>
                        <form method="POST" action="{{ route('sendMessage',$ticket->chat()->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row" style="display: flex;align-items: center">
                                <div class="input-field col s2">
                                    <button type="button" class="btn waves-effect waves-light blue darken-4"
                                            onclick="document.getElementById('file').click()"><i id="upload_icon"
                                                                                                 class="material-icons">file_upload</i>
                                    </button>
                                    <input type='file' name="file" id="file" style="display:none"
                                           onchange="document.getElementById('upload_icon').innerHTML='check'">
                                </div>
                                <div class="input-field col s7">
                                    <input class="validate" id="message" type="text" name="message">
                                    <label for="message" data-error="wrong"
                                           data-success="right"> Chat Message</label>
                                </div>
                                <div class="input-field col s3">
                                    <button type="submit" id="submit"
                                            class="btn waves-effect waves-light blue darken-4 col s12"><i
                                            class="material-icons">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $(".message-container").css('height', window.innerHeight - 500 + 'px');
                            $(".message-container").scrollTop($(".message-container")[0].scrollHeight);
                        });
                    </script>
                </div>
            @endcan
            @if(is_null(\Illuminate\Support\Facades\Auth::user()))
                <div class="col s12 m12 l6 xl6 card chat-container">
                    @include("auth.components.registerForm",["selected"=>3,"token"=> Request::route("token")])
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
        @if(!is_null(\Illuminate\Support\Facades\Auth::user())&&!is_null($ticket->craftsman_id))
            @include("components.profileModal",["user"=>\App\Models\User::where("id","=",$ticket->craftsman_id)->get()->first()])
        @endif
        @can("createEstimate",$ticket)
            @include("components.createEstimateModal",["ticket"=>$ticket])
        @endcan
        @can("approveEstimates",$ticket)
            @include("components.approveEstimatesModal",["estimates"=>$ticket->estimates()->get()])
        @endcan
    </div>
@endsection
