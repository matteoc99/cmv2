$(document).ready(function (){
    $(".message-container").css('height', window.innerHeight -500 + 'px');
    $(".message-container").scrollTop($(".message-container")[0].scrollHeight);

});
