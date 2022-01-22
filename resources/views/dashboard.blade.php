@extends("layouts.dashMaster")

@section("content")

    @if(is_countable($condominia)&&count($condominia)>0)
        <div class="row">
        @foreach($condominia as $condominium)
                @include("components.condominiumBox",["condominium", $condominium])
        @endforeach
        </div>
    @else
        @include("components.fabDiscovery")
    @endif
@endsection
