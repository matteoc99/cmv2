<div id="createEstimateModal" class="modal" style="min-height: 80%">
    <div class="modal-content" style="min-height: 100%">
        <h3 class="center">@lang("modals.createEstimate")</h3>
        <form method="POST" action="{{ route('createEstimate') }}">
            @csrf
            <input type="hidden" name="ticket" id="ticket" value="{{$ticket->id}}">
            <div class="row">
                <div class="input-field col s12">
                    <input class="validate" id="description" type="text" name="description" required>
                    <label for="description" data-error="wrong"
                           data-success="right">@lang("modals.description")  </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input class="validate" id="price" type="text" name="price" required>
                    <label for="price" data-error="wrong"
                           data-success="right"> @lang("modals.price") </label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input type="text" class="datepicker" name="estimated" id="estimated" required>
                    <label for="estimated" data-error="wrong"
                           data-success="right"> @lang("modals.estimatedCompletion")</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6 offset-m3">
                    <button type="submit"
                            class="btn waves-effect waves-light blue darken-4 col s12"> @lang("modals.create")
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

