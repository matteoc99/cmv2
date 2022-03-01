<div class="col s6 m3 l2 xl1 drag-drop" draggable="true" data-document="{{$doc->id}}">
    <a href="{{$doc->getFile()}}">
        <div class="card" style="margin-bottom: 0">
            <div class="card-image" style="padding: 10px">
                <img src="{{asset("uploads/doc.jpg")}}">
            </div>
            <a href="{{$doc->getFile()}}"><i class="material-icons blue-text text-darken-4">file_download</i></a>
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                <a href="#" class="right"><i class="material-icons blue-text text-darken-4">delete</i></a>
            @endif
        </div>
        <span class="card-title black-text" style="overflow-wrap: break-word;">{{$doc->name}}</span>
    </a>
</div>
