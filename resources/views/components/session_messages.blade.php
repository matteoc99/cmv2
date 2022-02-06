@if (isset($errors)&&$errors->any())
    <div class="card red-text center" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has("success"))
    <div class="card green-text center" role="alert">
        <ul>
            @foreach(session()->get("success") as $message)
                <li>{{$message}}</li>
            @endforeach
        </ul>
    </div>
@endif
