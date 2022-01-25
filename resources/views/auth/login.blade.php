@extends("layouts.AuthMaster")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4> @lang('auth.login') </h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">mail_outline</i>
                                <input class="validate" id="email" type="email" name="email" value="{{ old('email') }}"
                                       required>
                                <label for="email" data-error="wrong"
                                       data-success="right"> @lang('auth.mail') </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="password" type="password" name="password" required>
                                <a class="toggle-password blue-text text-darken-4" onclick="togglePassword('password')"><i class="material-icons">remove_red_eye</i></a>
                                <label for="password">@lang('auth.password') </label>
                            </div>
                            @if (session('credError'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>@lang("auth.wrongCreds")</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row ">
                            <div class="col s12 remember">
                                <p>
                                    <label>
                                        <input type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                        <span>@lang('auth.remember') </span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <button type="submit"
                                        class="btn waves-effect waves-light blue darken-4 col s12"> @lang('auth.login') </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6 m6 l6">
                                <p class="margin medium-small"><a
                                        href="{{route('register')}}">@lang('auth.registerCall') </a></p>
                            </div>
                            <div class="input-field col s6 m6 l6">
                                <p class="margin right-align medium-small">
                                    @if (Route::has('passwordForgotten'))
                                        <a class="" href="{{ route('passwordForgotten') }}">
                                            @lang('auth.passwordForgotten')
                                        </a>
                                    @endif
                                </p>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
