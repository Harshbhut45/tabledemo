function notify(message, type = 'success', icon = 'check') {
    if (type == 'danger') {
        icon = 'times';
    } else if (type === 'info') {
        icon = 'info'
    }

    Codebase.helpers('notify', {
        type: type,
        icon: 'fa fa-' + icon + ' mr-5',
        message: message
    });
}
