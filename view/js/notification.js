$(document).ready(function () {
    $('.toast').toast('show');
    let notificationQuantity = 0;
    setInterval(notificating, 5000);
    notificating();

    function notificating() {
        let notifications;
        $.post('/spaceair/controller/api/NotificationsApi.php', function (data) {
            if (data.msg != "ko") {
                notifications = data.msg;
                const l = Object.keys(notifications).length;
                updateBadge(l);
                $("div.my-toast-position").empty();
                $("div.my-toast-position").append(formatData(notifications));
                $('.toast').toast('show');
            }
        }, 'json');
    }

    function updateBadge(notificationQnt) {
        notificationQuantity = notificationQnt;
        $("span.notification-badge").text(notificationQnt);
        if (notificationQnt == 0) {
            $("span.notification-badge").attr("class", "badge invisible");
        } else {
            $("span.notification-badge").attr("class", "badge visible");
        }

    }

    function formatData(notifications) {
        let res = "";
        notifications.forEach(notification => {
            res += "<div role=\"status\" aria-live=\"polite\" aria-atomic=\"true\" class=\"toast\" data-autohide=\"false\" data-animation=\"false\">";
            res += "<div class=\"toast-header\">";
            res += "<strong class=\"mr-auto\">" + notification.date + "</strong>";
            res += "<button id = " + notification.id + " type=\"button\" class=\"ml-2 mb-1 close close-toast\" data-dismiss=\"toast\" aria-label=\"Close\">";
            res += "&times;";
            res += "</button>";
            res += "</div>";
            res += "<div class=\"toast-body\">";
            res += "<p class=\"mb-0\">" + notification.title + "</p>";
            res += "</div></div>"
        });
        return res;
    }

    $("body").on('click', '.close-toast', function () {
        const id = $(this).attr('id');
        notificationQuantity--;
        updateBadge(notificationQuantity);
        $.post('/spaceair/controller/api/DeleteNotificationApi.php', { id: id });
    });
});
