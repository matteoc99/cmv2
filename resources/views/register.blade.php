@extends("layouts.AuthMaster")

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4> @lang('auth.register') </h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                       >
                                <label for="name">@lang("auth.name")</label>
                                <div class="col">
                                    @foreach($errors->get("name") as $error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$error}}</strong>
                                        </span>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">mail_outline</i>
                                <input class="validate" id="email" type="email" name="email"
                                       value="{{ old('email') }}"
                                       required >
                                <label for="email" data-error="wrong"
                                       data-success="right"> @lang('auth.mail') </label>
                                <div class="col">
                                    @foreach($errors->get("email") as $error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$error}}</strong>
                                        </span>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="password" type="password" name="password" required>
                                <label for="password">@lang('auth.password') </label>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="password-confirm" type="password" name="password_confirmation" required>
                                <label for="password-confirm">@lang('auth.passwordConf') </label>
                            </div>
                                <div class="col">
                                @foreach($errors->get("password") as $error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$error}}</strong>
                                        </span>
                                    <br>
                                    @endforeach
                                </div>

                            <div class="input-field col s12">
                                <select class="browser-default" id="role" name="role">
                                    <option value="2">@lang("auth.administrator")</option>
                                    <option value="3">@lang("auth.worker")</option>
                                </select>
                            </div>
                            @include("components.agree_checkbox")
                            <div class="row">
                                <div class="input-field col s12 m6 offset-m3">
                                    <button type="submit"
                                            class="btn waves-effect waves-light blue darken-4 col s12"> @lang('auth.register') </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
