@extends("layouts.AuthMaster")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4> @lang('auth.changePassword') </h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('changePassword') }}">
                        @csrf

                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="password" type="password" name="password" required>
                                <label for="password">@lang('auth.newPassword') </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="password_confirmation" type="password" name="password_confirmation" required>
                                <label for="password_confirmation">@lang('auth.newPasswordConfirm') </label>
                            </div>
                            <div class="col">
                                @foreach($errors->get("password") as $error)
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{$error}}</strong>
                                        </span>
                                    <br>
                                @endforeach
                                    @foreach($errors->get("password_confirmation") as $error)
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
                                        class="btn waves-effect waves-light blue darken-4 col s12"> @lang('auth.changePassword') </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
