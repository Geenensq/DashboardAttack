function notify($icon, $message, $type) {

    $.notify({
        icon: $icon,
        message: $message

    }, {
        type: $type,
        timer: 4000
    });

}