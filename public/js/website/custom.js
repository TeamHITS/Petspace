function ajaxPost(url, data, callback, formdata = true) {
    $.ajaxSetup({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if (formdata) {
        $.ajax({
            method: "POST",
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function () {
                $('body .spinner').css('display', 'block');
            },
            success: function (rdata) {
                $('.spinner').css('display', 'none');
                callback(true, rdata)
            }, error: function (edata) {
                $('.spinner').css('display', 'none');
                callback(false, edata)
            }
        });
    } else {
        $.ajax({
            method: "POST",
            url: url,
            data: data,
            cache: false,
            dataType: 'json',
            success: function (rdata) {
                callback(true, rdata)
            }, error: function (edata) {
                callback(false, edata)

            }
        });
    }

}

function ajaxGet(url, queryParam, callback) {
    $.ajax({
        method: "GET",
        url: url,
        data: queryParam,
        dataType: 'json',
        success: function (rdata) {
            callback(true, rdata)
        }, error: function (edata) {

            callback(false, edata)

        }
    });
}

function defaultFormat(state) {
    return state.text;
}

$('.select2').each(function () {
    var format = $(this).data('format') ? $(this).data('format') : "defaultFormat";
    $(this).select2({
        theme: "bootstrap",
        templateResult: window[format],
        templateSelection: window[format],
        escapeMarkup: function (m) {
            return m;
        }
    });
});

function goBack() {
    window.history.back(function () {
        location.reload();
    });
}