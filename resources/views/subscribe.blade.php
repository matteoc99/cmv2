@extends("layouts.dashMaster")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col s12 m6">
                @include("components.planBox",["plan"=>$plan])
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <h3 class="center">{{ __('Subscribe') }}</h3>
                    <form action="{{route("subscribe",$plan->id)}}" method="POST" id="paymentForm">
                        @csrf
                        <input type="hidden" name="platform" id="platform">
                        @foreach($platforms as $platform)
                            <a onclick="setPlatform('{{$platform->id}}')">
                                <img class="img-thumbnail" src="{{asset($platform->image)}}">
                            </a>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setPlatform(platform){
            $("#platform").val(platform);
            $("#paymentForm").submit();
        }
    </script>
@endsection
