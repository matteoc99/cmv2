<div class="col s12 m6">
    <div class="card" style="padding: 25px">
        <div class="row">
            <div class="col s12 m10">
                <span>{{$estimate->desc}}</span><br>
                <span>Price: {{$estimate->price}}</span><br>
                <span>Estimated Completition: {{$estimate->estimated_completition}}</span>
            </div>
            <div class="col s12 m2">
                <a href="{{route("approveEstimate",$estimate->id)}}"><i class="material-icons">check</i></a>
            </div>
        </div>
    </div>
</div>
