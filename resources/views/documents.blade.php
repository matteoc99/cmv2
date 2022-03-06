@extends("layouts.dashMaster ")

@section("content")

    <div class="container">
        <h3><a href="{{route("condominium",$condominium->id)}}"><i
                    class="material-icons small blue-text text-darken-4">arrow_back</i></a><i
                class="material-icons small">domain</i>{{$condominium->name}}</h3>
        <div class="row">
            @forelse($docs as $doc)

                @if($doc->isFolder)
                    @include("components.boxes.folderBox",["doc"=>$doc])
                @else
                    @include("components.boxes.documentBox",["doc"=>$doc])
                @endif

            @empty
                <h5 class="center">
                    @lang("document.empty")
                </h5>
            @endforelse
        </div>
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            @include("components.scripts.moveDocumentsScript",["condominium"=>$condominium])
            @include("components.modals.addDocumentModal")
            @include("components.modals.addFolderModal")
        @endif
    </div>
@endsection
