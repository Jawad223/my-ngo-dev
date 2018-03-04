/* Notification methods */
function load_unseen_notification(view) {
    $.ajax({
        url: 'http://localhost/ngo/notification/fetch',
        method: "POST",
        data: {view: view},
        dataType: "json",
        success: function (data) {
            $('.drop-menu').html(data.notification);
            if (data.unseen_notification > 0) {
                $('.count').html(data.unseen_notification);
            }
        }
    });
}

$(document).on('click', '.dropdown-toggle', function () {
    $('.count').html('');
    load_unseen_notification('yes');
});

setInterval(function () {
    load_unseen_notification();
}, 25000);
