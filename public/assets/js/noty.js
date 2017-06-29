function error_noty(msg) {
    var n = noty({
        text: msg,
        theme: 'bootstrapTheme',
        type:'error',
        closeWith: ['click'],
        timeout:5000
    });
}