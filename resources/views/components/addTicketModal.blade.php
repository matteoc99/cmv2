<!-- Modal Structure -->
<div id="addTicketModal" class="modal">
    <div class="modal-content">
        <h4>Add a ticket via Link</h4>
        <form method="POST" action="{{ route('addToCraftsman') }}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">insert_link</i>
                    <input class="validate" id="link" type="text" name="link"
                           required>
                    <label for="link" data-error="wrong"
                           data-success="right"> Insert Link </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6 offset-m3">
                    <button type="submit"
                            class="btn waves-effect waves-light blue darken-4 col s12">Add Ticket</button>
                </div>
            </div>
        </form>
    </div>
</div>
