<div class="fixed-action-btn">
    <a class="btn-floating btn-large blue">
        <i class="large material-icons">add</i>
    </a>
    <ul>
        @if(Request::route()->getName()=="condominium")
            <li><a href="{{route("createFamily")}}" class="btn-floating blue lighten-1"><i class="material-icons">group_add</i></a>
            </li>
        @endif
        <li><a href="{{route("createCondominium")}}" class="btn-floating blue lighten-1"><i
                    class="material-icons">home</i></a></li>
        <li><a class="btn-floating blue lighten-1"><i class="material-icons">attach_file</i></a></li>
        <li><a class="btn-floating blue lighten-1"><i class="material-icons">insert_drive_file</i></a></li>
        <li><a class="btn-floating blue lighten-1"><i class="material-icons">help</i></a></li>

    </ul>
</div>
