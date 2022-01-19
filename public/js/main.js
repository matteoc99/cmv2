
$(document).ready(function(){
    M.AutoInit();

    $(".scrollto").click(function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#"+$(this).data("value")).offset().top
        }, 500);
        return false;
    });
});
