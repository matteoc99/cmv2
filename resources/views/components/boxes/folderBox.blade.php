<div class="col s6 m3 l2 xl1 dropzone drag-drop" data-folder="{{$doc->id}}"  data-document="{{$doc->id}}">
    @if(!is_null($doc->id))
        <a href="{{route("folder",["condominium"=>$doc->condominium_id,"document"=>$doc->id])}}">
            @else
                <a href="{{route("documents",["condominium"=>$doc->condominium_id])}}">
                    @endif
                    <div class="card" style="margin-bottom: 0">
                        <div class="card-image" style="padding: 10px">
                            <img src="{{asset("uploads/folder.ico")}}">
                        </div>
                        @if(!is_null($doc->id))
                            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                <a href="{{route("documents.delete",["condominium"=>$doc->condominium_id,"document"=>$doc->id])}}"><i
                                        class="material-icons blue-text text-darken-4">delete</i></a>
                            @endif
                        @endif
                    </div>
                    <span class="card-title black-text" style="overflow-wrap: break-word;">{{$doc->name}}</span>
                </a>
</div>

