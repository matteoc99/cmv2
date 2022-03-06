<div class="col s6 m6 l4 xl3">
    <div class="card blue darken-4">
        <div class="card-content white-text">
            <span class="card-title">{{$family->name}}</span>
            <p>{{$family->count}}</p>
        </div>
        <div class="card-action">
            <form method="POST" action="{{route("deleteFamily",$family->id)}}" id="deleteForm-{{$family->id}}">
                @csrf
                @can("update",$family)
                    <a href="{{route("editFamily",[$condominium->id,$family->id])}}">@lang("family.edit")</a>
                @endcan
                @can("delete", $family)
                    <a onclick="$('#deleteForm-{{$family->id}}').submit();" href="#">@lang("family.delete")</a>
                @endcan
            </form>
        </div>
    </div>
</div>
