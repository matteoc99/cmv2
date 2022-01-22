@extends("layouts.dashMaster")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4>Create Ticket</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('createTicketPost') }}">
                        @csrf
                        <input type="hidden" name="condominium" id="condominium"
                               value="{{Request::route('condominium')}}">
                        <div class="row">
                            <div class="input-field col s12">
                                <input class="validate" id="title" type="text" name="title">
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
                                <input class="validate" id="desc" type="text" name="desc">
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

                        <div class="input-field col s12">
                            <select name="urgency">
                                @foreach($urgencies as $urgency)
                                    <option value="{{$urgency->id}}">{{$urgency->nameEn}}</option>
                                @endforeach
                            </select>
                            <label>Urcency</label>
                        </div>
                        <div class="input-field col s12">
                            <select name="tag">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->nameEn}}</option>
                                @endforeach
                            </select>
                            <label>Tag</label>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <button type="submit"
                                        class="btn waves-effect waves-light blue darken-4 col s12"> Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
