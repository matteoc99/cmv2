<div id="addFolderModal" class="modal">
    <div class="modal-content">
        <h4 class="center">@lang("modals.createFolderTitle")</h4>
        <form method="POST" action="{{ route('documents.folder.add',Request::route("condominium")) }}">
            @csrf
            <input type="hidden" name="condominium_id" value="{{Request::route("condominium")}}">
            <input type="hidden" name="parent_id" value="{{Request::route("document")}}">
            <div class="row">
                <div class="input-field col s12">
                    <input class="validate" id="name" type="text" name="name"
                           required>
                    <label for="name" data-error="wrong"
                           data-success="right"> @lang("modals.name") </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6 offset-m3">
                    <button type="submit"
                            class="btn waves-effect waves-light blue darken-4 col s12">@lang("modals.createFolder")</button>
                </div>
            </div>
        </form>

    </div>
</div>
