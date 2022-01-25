$(document).ready(function () {
    M.AutoInit();

    $('.fixed-action-btn').click(function () {
        var instance = M.FloatingActionButton.getInstance(document.querySelectorAll('.fixed-action-btn')[0]);
        if (instance.isOpen)
            instance.close();
        else
            instance.open();
    })

    $(".scrollto").click(function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#" + $(this).data("value")).offset().top
        }, 500);
        return false;
    });
});

function togglePassword(id){
    var input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}
