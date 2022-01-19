@extends("layouts.dashMaster")

@section("content")
@if(count($condominia)>0)
    <ul class="collapsible">
        @foreach($condominia as $condominium)
            <li>
                <div class="collapsible-header">
                    <pre><b>{{$condominium->name}}</b></pre>
                </div>
                <div class="collapsible-body">
                    <pre>{{$condominium->address}}</pre>
                </div>
            </li>
        @endforeach
    </ul>
@endif
@endsection
