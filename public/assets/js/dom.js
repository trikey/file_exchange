$('document').ready(function () {
    $('[data-toggle="popover"]').popover();
    $('.menu-icon').on('click', function () {
        $('.menu').toggleClass('opened-menu');
        return false;
    });

    $('.open-search').on('click', function () {
        $('.search-form').addClass('opened-search');
        $('.search-filed').focus();
        return false;
    });
    $('.close-search').on('click', function () {
        $('.search-form').removeClass('opened-search');
        return false;
    });
    $('.row-with-popup').mousemove(function () {
        var left = event.clientX - $(this).offset().left + 30;
        var top = event.clientY + $(window).scrollTop() - $(this).offset().top;
        var popup =$(this).children('.file-popup');
        if ( (popup.outerWidth() + left + 70) > $(window).innerWidth()) {
            left = left - popup.outerWidth() - 50;
        }
        $(this).children('.file-popup').css({'left': left, 'top': top});
    });
    $(document).on('change', '#file',function () {
        $('.upload-file-name').text($(this).val());
    });
});