<a href="{{route("folder",["condominium"=>$doc->condominium_id,"document"=>$doc->id])}}">
    <div class="col s6 m3 l3 xl1">
        <div class="card" style="margin-bottom: 0">
            <div class="card-image" style="padding: 10px">
                <img src="{{asset("uploads/folder.ico")}}">
            </div>
        </div>
        <span class="card-title black-text" style="overflow-wrap: break-word;">{{$doc->name}}</span>
    </div>

</a>
