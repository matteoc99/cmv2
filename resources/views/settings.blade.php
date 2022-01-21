@extends("layouts.dashMaster")

@section("content")
    <div class="container">

        <div class="row">
            <div class="col s12 m8 l6 xl4 card offset-l3 offset-m2 offset-xl4">
                <div class="card-header center"><h4>Settings</h4></div>
                <div class="card-body">

                    <form method="POST" action="{{ route('updateSettings') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="display: flex; flex: 1">
                            <div class="input-field col s4 ">
                                <img class="materialboxed" width="100%" src="{{$img}}">
                            </div>
                            <div class="input-field col s8" style="align-self: flex-end">
                                <button  type="button" class="btn waves-effect waves-light blue darken-4" onclick="document.getElementById('profile_image').click()">Change Profile Picture</button>
                                <input type='file' name="profile_image" id="profile_image" style="display:none">
                            </div>
                            @foreach($errors->get("profile_image") as $error)
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{$error}}</strong>
                                        </span>
                                <br>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input class="validate" id="first_name" type="text" name="first_name"
                                       value="{{$setting->first_name}}">
                                <label for="first_name" data-error="wrong"
                                       data-success="right"> First Name </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input class="validate" id="last_name" type="text" name="last_name"
                                       value="{{$setting->last_name}}">
                                <label for="last_name" data-error="wrong"
                                       data-success="right"> Last Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input class="validate" id="desc" type="text" name="desc"
                                       value="{{$setting->desc}}">
                                <label for="desc" data-error="wrong"
                                       data-success="right"> Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <button type="submit"
                                        class="btn waves-effect waves-light blue darken-4 col s12"> Update
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            @if(session()->has('success'))
                <script>
                    M.toast({html: 'Saved Successfully', classes: 'rounded blue darken-4 center'});
                </script>
            @endif
        </div>
    </div>
@endsection
