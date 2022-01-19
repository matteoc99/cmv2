@extends("layouts.dashMaster")

@section("content")
    @if(count($condominia)>0)
        <div class="row">
        @foreach($condominia as $condominium)
                @include("components.condominiumBox",["condominium", $condominium])
        @endforeach
        </div>
    @endif
@endsection
