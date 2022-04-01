
@extends("layouts.dashMaster")

@section("content")
    <div class="container">
        <h3><a href="{{route("condominium",$condominium->id)}}"><i
                    class="material-icons small blue-text text-darken-4">arrow_back</i></a><i
                class="material-icons small">domain</i>{{$condominium->name}} : {{ $family->name}}</h3>
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4>@lang("family.editTitle")</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('editFamilyPost',$family->id) }}">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">people</i>
                                <input class="validate" id="name" type="text" name="name" value="{{$family->name}}">
                                <label for="name" data-error="wrong"
                                       data-success="right"> @lang("family.name")</label>
                            </div>
                            @if($errors->get("name"))
                                <span class="invalid-feedback" role="alert">
                                            <strong>@lang("family.nameMissing")</strong>
                                        </span>
                                <br>
                            @endif
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <button type="submit"
                                        class="btn waves-effect waves-light blue darken-4 col s12">@lang("family.update")
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
