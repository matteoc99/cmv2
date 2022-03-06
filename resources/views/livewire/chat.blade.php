<div wire:poll class=" row message-container">
    @forelse(\App\Models\Message::where("chat_id","=",$chat->id)->get() as $message)
        @include("components.boxes.messageBox",["message"=>$message])
        @php
            if($message->isNew()){
                $usermessage = new \App\Models\UserMessage();
                $usermessage->user_id=\Illuminate\Support\Facades\Auth::user()->id;
                $usermessage->message_id=$message->id;
                $usermessage->read = true;
                $usermessage->save();
            }
        @endphp
    @empty
        <p>@lang("ticket.noMessages")</p>
    @endforelse
    <script>
        $(".message-container").css('height', window.innerHeight - 500 + 'px');
    </script>
</div>


