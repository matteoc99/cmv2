$(document).ready(function () {

    M.AutoInit();
    M.updateTextFields();
    var elems = document.querySelectorAll('.datepicker');
    M.Datepicker.init(elems, {"format": "yyyy/mm/dd"});

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

function togglePassword(id) {
    var input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}

function togglePriceContainer() {
    if ($('#contractType').val() == 2) {
        $('#price-container').show()
    } else {
        $('#price-container').hide()
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text);
}

$(window).load(function(){
    $('input:-webkit-autofill').each(function(){
        if ($(this).val().length !== "") {
            $(this).siblings('label, i').addClass('active');
        }
    });
});
