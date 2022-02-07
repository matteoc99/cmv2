<div class="row">
    <div class="col s12 m12 l8 xl6 card offset-l2 offset-xl3">
        <div class="card-header center"><h4>Subscription Settings</h4></div>
        <div class="card-body">
            <h5 class="center">Current Plan</h5>
            @include("components.planBox",["plan"=>\Illuminate\Support\Facades\Auth::user()->subscription()->plan()])
            <h5 class="center">Change Plan</h5>
            @include("components.pricing",["size"=>" s12 m6 l6"])
        </div>
    </div>
</div>
