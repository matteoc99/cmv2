@extends("layouts.dashMaster")

@section("content")
    <div class="container">
        <h3><a href="{{route("condominium",$condominium->id)}}"><i
                    class="material-icons small blue-text text-darken-4">arrow_back</i></a><i
                class="material-icons small">domain</i>{{$condominium->name}}</h3>
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4>@lang("ticket.createTitle")</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('createTicketPost') }}">
                        @csrf
                        <input type="hidden" name="condominium" id="condominium"
                               value="{{Request::route('condominium')}}">
                        <div class="row">
                            <div class="input-field col s12">
                                <input class="validate" id="title" type="text" name="title" value="{{old("title")}}">
                                <label for="title" data-error="wrong"
                                       data-success="right"> @lang("ticket.title") </label>
                            </div>
                            @if($errors->get("title"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>@lang("ticket.titleMissing") </strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input class="validate" id="desc" type="text" name="desc" value="{{old("desc")}}">
                                <label for="desc" data-error="wrong"
                                       data-success="right"> @lang("ticket.desc")</label>
                            </div>
                            @if($errors->get("desc"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>@lang("ticket.descMissing") </strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input class="validate" id="phone" type="text" name="phone" value="{{old("phone")}}">
                                <label for="phone" data-error="wrong"
                                       data-success="right">@lang("ticket.phone")</label>
                            </div>
                            @if($errors->get("phone"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>@lang("ticket.phoneMissing") </strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <div class="input-field col s12">
                                <select name="contractType" id="contractType" onchange="togglePriceContainer()">
                                    @foreach($contractTypes as $contractType)
                                        <option value="{{$contractType->id}}" {{old("contractType")==$contractType->id?"selected":""}}>{{$contractType->name()}}</option>
                                    @endforeach
                                </select>
                                <label>@lang("ticket.contractType")</label>
                            </div>
                            <div class="input-field col s12" id="price-container" style="display: none">
                                <input class="validate" id="price" type="text" name="price" value="{{old("price")}}">
                                <label for="price" data-error="wrong"
                                       data-success="right"> @lang("ticket.price")</label>
                            </div>
                            @if($errors->get("price"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>@lang("ticket.priceMissing") </strong>
                                        </span>
                                <br>
                            @endif
                        @endif
                        <div class="input-field col s12">
                            <select name="urgency">
                                @foreach($urgencies as $urgency)
                                    <option value="{{$urgency->id}}" {{old("urgency")==$urgency->id?"selected":""}} >{{$urgency->name()}}</option>
                                @endforeach
                            </select>
                            <label>@lang("ticket.urgency")</label>
                        </div>
                        <div class="input-field col s12">
                            <select name="tag">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" {{old("tag")==$tag->id?"selected":""}}>{{$tag->name()}}</option>
                                @endforeach
                            </select>
                            <label>@lang("ticket.tag")</label>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <button type="submit"
                                        class="btn waves-effect waves-light blue darken-4 col s12">@lang("ticket.create")
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
