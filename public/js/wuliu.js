var timer = null;
$.flashToast = function(option) {
    clearTimeout(timer);
    var options = $.extend({
        position: 'center', //top,center,bottom
        type: 'warning', //success,warning,error
        message: '',
        time: 3000
    }, option);
    var type_icon = (options.type == 'success') ? 'check-circle-o' : 'exclamation-triangle';
    if ($('.flash-toast').length > 0) {
        $('.flash-toast').css('margin-left', '');
        $('.flash-toast').attr('class', 'flash-toast flash-toast-type-' + options.type).html('<i class="fa fa-' + type_icon + '"></i> ' + options.message);
    } else {
        $('body').append('<div class="flash-toast flash-toast-type-' + options.type + '"><i class="fa fa-' + type_icon + '"></i> ' + options.message + '</div>');
    }
    $('.flash-toast').css('margin-left', '-' + (options.message.length * 15) / 2 + 'px');

    $('.flash-toast').addClass('flash-toast-pos-' + options.position).fadeIn();
    timer = setTimeout(function() {
        $('.flash-toast').fadeOut();
    }, options.time);
}