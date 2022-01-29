<div class="row flex">
    <div class="col card-container s12 m6 l6 ">
        @include("components.planBox",["plan"=>\App\Models\Plan::where("id","=",1)->get()->first()])
    </div>
    <div class="col card-container s12 m6 l6 ">
        @include("components.planBox",["plan"=>\App\Models\Plan::where("id","=",2)->get()->first()])
    </div>
    <div class="col card-container s12 m6 l6 ">
        @include("components.planBox",["plan"=>\App\Models\Plan::where("id","=",3)->get()->first(),"ribbon"=>true])
    </div>
    <div class="col s12 m6 l6  card-container">
        @include("components.planBox",["plan"=>\App\Models\Plan::where("id","=",4)->get()->first()])
    </div>
</div>
