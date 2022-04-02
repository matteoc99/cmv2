<div id="importUserModal" class="modal">
    <div class="modal-content">
        <h4 class="center">@lang("modals.userImportTitle")</h4>
        <form method="POST" action="{{ route('user.import.excel')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="condominium" id="condominium"
                   value="{{Request::route('condominium')}}">
            <div class="row">
                <div class="input-field col s12 center">
                    <img src="{{asset("img/excelImportExample.png")}}">
                </div>
                <div class="input-field col s12 center">
                    <button type="button" class="btn waves-effect waves-light blue darken-4"
                            onclick="document.getElementById('excel').click()">@lang("modals.userImportSelect")
                    </button>
                    <input type='file' name="excel" id="excel" style="display:none"
                           onchange="document.getElementById('submit').click()">
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
