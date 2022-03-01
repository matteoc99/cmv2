@extends("layouts.dashMaster ")

@section("content")

    <div class="container">
        @if(is_null($folder->parent_id))
            <h3><a href="{{route("documents",$condominium->id)}}"><i
                        class="material-icons small blue-text text-darken-4">arrow_back</i></a><i
                    class="material-icons small">folder</i>{{$folder->name}}</h3>
        @else
            <h3><a href="{{route("folder",[$condominium->id,$folder->parent_id])}}"><i
                        class="material-icons small blue-text text-darken-4">arrow_back</i></a><i
                    class="material-icons small">folder</i>{{$folder->name}}</h3>
        @endif
        <div class="row">
            @forelse($docs as $doc)

                @if($doc->isFolder)
                    @include("components.boxes.folderBox",["doc"=>$doc])
                @else
                    @include("components.boxes.documentBox",["doc"=>$doc])
                @endif

            @empty
                <h5 class="center">
                    This Folder is empty
                </h5>
            @endforelse
        </div>
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            @include("components.modals.addDocumentModal")
            @include("components.modals.addFolderModal")
        @endif
    </div>
@endsection
