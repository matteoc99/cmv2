
@extends("layouts.dashMaster")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4>Header</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('createFamilyPost') }}">
                        @csrf
                        <input type="hidden" name="condominium" id="condominium" value="{{Request::route('condominium')}}">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">people</i>
                                <input class="validate" id="name" type="text" name="name">
                                <label for="name" data-error="wrong"
                                       data-success="right"> Name </label>
                            </div>
                            @if($errors->get("name"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>The Name is missing </strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">email</i>
                                <input class="validate" id="email" type="email" name="email">
                                <label for="email" data-error="wrong"
                                       data-success="right"> E-Mail </label>
                            </div>
                            @if($errors->get("email"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>The email is missing </strong>
                                        </span>
                                <br>
                            @endif
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">child_friendlya</i>
                                <input class="validate" id="count" type="number" name="count" min="0">
                                <label for="count" data-error="wrong"
                                       data-success="right"> Family Size </label>
                            </div>

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
