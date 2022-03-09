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

function waitForJQuery() {
    console.log("wait");
    if (window.jQuery) {
        var elems = document.querySelectorAll('.modal.cookie-modal ');
        var instances = M.Modal.init(elems, {
            dismissible: true
        });
        instances.forEach(function (elem, index, array) {
            elem.open();

        });
        $("#cookie-modal").siblings(".modal-overlay").click(function () {
            $("#cookie-modal").find(".modal-close").click();

        });


    } else {
        setTimeout(waitForJQuery, 500);
    }
}

