<div class="col s6 m3 l2 xl1 dropzone drag-drop" data-folder="{{$doc->id}}">
    <a href="{{route("folder",["condominium"=>$doc->condominium_id,"document"=>$doc->id])}}">
        <div class="card" style="margin-bottom: 0">
            <div class="card-image" style="padding: 10px">
                <img src="{{asset("uploads/folder.ico")}}">
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                <a href="#"><i class="material-icons blue-text text-darken-4">delete</i></a>
            @endif
        </div>
        <span class="card-title black-text" style="overflow-wrap: break-word;">{{$doc->name}}</span>
    </a>
</div>

