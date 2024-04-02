const onImg =  '../../img/heart_on.png'
const offImg =  '../../img/heart_off.png'

// お気に入りボタン
$('.img__favorite').on('click', function () {
    // console.log($(this).data('user_id'), $(this).data('store_id'));
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
            // "user_id": obj.data('user_id'),
            "store_id": obj.data('store_id')
        },
    }).done(function (res) {
        console.log('success', res);
        if (isOn) {
            obj.attr('src', '../../img/heart_off.png');
        }
        else {
            obj.attr('src', '../../img/heart_on.png');
        }
    }).fail(function(XMLHttpRequest, textStatus, errorThrown){
        console.log(XMLHttpRequest.status);
        console.log(textStatus);
        console.log(errorThrown);
    });
});
