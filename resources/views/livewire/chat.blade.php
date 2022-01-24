<div wire:poll class=" row message-container">
    @forelse(\App\Models\Message::where("chat_id","=",$chat->id)->get() as $message)
        @include("components.messageBox",["message"=>$message])
    @empty
        <p> no Messages yet</p>
    @endforelse
    <script>
        $(document).ready(function () {
            $(".message-container").css('height', window.innerHeight - 500 + 'px');
        });
    </script>
</div>


