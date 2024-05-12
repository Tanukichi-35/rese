const onImg =  '../../img/heart_on.svg'
const offImg =  '../../img/heart_off.svg'

// お気に入りボタン
$('.img__favorite').on('click', function () {
    let postURL = "/favoriteOn";
    let obj = $(this);
    let isOn = obj.attr('src').includes('heart_on');
    if (isOn) {
        postURL = "/favoriteOff";
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: postURL,
        type: "POST",
        data: {
            "store_id": obj.data('store_id')
        },
    }).done(function (res) {
        console.log('success', res);
        if (isOn) {
            obj.attr('src', '../../img/heart_off.svg');
        }
        else {
            obj.attr('src', '../../img/heart_on.svg');
        }
    }).fail(function(XMLHttpRequest, textStatus, errorThrown){
        console.log(XMLHttpRequest.status);
        console.log(textStatus);
        console.log(errorThrown);
    });
});
