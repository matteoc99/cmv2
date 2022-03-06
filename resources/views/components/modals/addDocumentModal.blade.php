<div id="addDocumentModal" class="modal">
    <div class="modal-content">
        <h4 class="center">Add one or more Documents</h4>
        <form method="POST" action="{{ route('documents.add',Request::route("condominium")) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="condominium_id" value="{{Request::route("condominium")}}">
            <input type="hidden" name="parent_id" value="{{Request::route("document")}}">
            <div class="row">
                <div class="input-field col s12 center">
                    <button type="button" class="btn waves-effect waves-light blue darken-4"
                            onclick="document.getElementById('documents').click()">@lang("modals.selectDocuments")
                    </button>
                    <input type='file' name="documents[]" id="documents" style="display:none" multiple onchange="document.getElementById('submit').click()">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6 offset-m3">
                    <button type="submit" id="submit" style="display: none"
                            class="btn waves-effect waves-light blue darken-4 col s12">@lang("modals.addDocument")
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
