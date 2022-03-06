<div class="col s12 m6">
    <div class="card" style="padding: 25px">
        <div class="row">
            <div class="col s12 m10">
                <h4>{{\App\Models\User::where("id","=",$estimate->user_id)->get()->first()->name()}}</h4>
                <span>{{$estimate->desc}}</span><br>
                <span>@lang("estimate.price"): {{$estimate->price}}</span><br>
                <span>@lang("estimate.completion"): {{$estimate->estimated_completition}}</span>
            </div>
            <div class="col s12 m2">
                <a href="{{route("approveEstimate",$estimate->id)}}"><i class="material-icons">check</i></a>
            </div>
        </div>
    </div>
</div>
