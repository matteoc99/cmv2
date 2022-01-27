<div class="row">
    <div class="col s12 m12 l8 xl6 card offset-l2 offset-xl3">
        <div class="card-header center"><h4>Notification Settings</h4></div>
        <div class="card-body">

            <form method="POST" action="{{ route('updateNotificationSettings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <p>
                            <label>
                                <input id="ticket_notification" type="checkbox" name="ticket_notification"
                                    {{$setting->recive_ticket_created_notification?"checked=''":""}}>
                                <span>Receive a Notification when a new Ticket is created</span>
                            </label>
                        </p>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->isCraftsman())
                        <div class="input-field col s12">
                            <p>
                                <label>
                                    <input id="estimate_notification" type="checkbox" name="estimate_notification"
                                        {{$setting->revice_approved_estimate_notification?"checked=''":""}}>
                                    <span>Receive a Notification when your estimate has been Approved</span>
                                </label>
                            </p>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 offset-m3">
                        <button type="submit" id="submit"
                                class="btn waves-effect waves-light blue darken-4 col s12"> Update
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
