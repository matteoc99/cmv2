@extends("layouts.AuthMaster")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4> @lang('auth.resetPassowrd') </h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('reset') }}">
                        @csrf
                        <input type="hidden" name="token" id="token"
                               value="{{Request::route('token')}}">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">mail_outline</i>
                                <input class="validate" id="email" type="email" name="email" value="{{ old('email') }}"
                                       required>
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
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <button type="submit"
                                        class="btn waves-effect waves-light blue darken-4 col s12"> @lang('auth.sendVerification') </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
