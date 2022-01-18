
$(document).ready(function(){
    M.AutoInit();

    $(".pricing").click(function () {
        window.location.replace("http://dev.auth.cm.com");
    });

    $(".scrollto").click(function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#"+$(this).data("value")).offset().top
        }, 500);
        return false;
    });
});
