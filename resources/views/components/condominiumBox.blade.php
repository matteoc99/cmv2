<div class="col s12 m6 l4 xl3">
    <div class="card blue darken-4">
        <div class="card-content white-text">
            <span class="card-title">{{$condominium->name}}</span>
            <p>{{$condominium->address}}</p>
            <p>{{$condominium->period}}</p>
        </div>
        <div class="card-action">
            <a href="{{route("condominium",$condominium->id)}}">Manage</a>
            <a href="{{route("editCondominium",$condominium->id)}}" class="right">Edit</a>
        </div>
    </div>
</div>
