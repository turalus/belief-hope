$(document).ready(function () {
    $(".menu-elem").click(function () {
        window.location.href = $(this).data("url");
        return false;
    });

    $(".mpslider-item").click(function () {
        window.location.replace($(this).data("href"));
    });


    addthis.layers({
        'theme': 'transparent',
        'share': {
            'position': 'left',
            'numPreferredServices': 5
        }
    });

    $('.carousel').carousel();
});

