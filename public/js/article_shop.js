$(document).ready(function () {

    $('.js-like-article').on('click', function (e) {
    e.preventDefault();

    let $link = $(e.currentTarget);
    $link.toggleClass('fa-heart-o').toggleClass('fa-heart');
    });

    $('.js-buy-article').on('click', function (e) {
        e.preventDefault();

        let $link2 = $(e.currentTarget);
        $link2.toggleClass('btn-active');

        $(this).children('i').toggleClass('buy-article').toggleClass('added-article');
        // $(this).next('i').toggleClass('added-article');
        // let $link = $($('#menu-icon').currentTarget);
        // $link.toggleClass('buy-article').toggleClass('added-article');

        // let $element = document.getElementById("menu-icon");
        // $element.toggleClass('buy-article').toggleClass('added-article');
    });



    var Elem1 = $('.element1');
    var Elem2 = $('.element2');

    $('.prev').on('click', function (e) {
        e.preventDefault();

        Elem2.removeClass('current');
        Elem1.addClass('current');
    });

    $('.next').on('click', function (e) {
        e.preventDefault();

        Elem1.removeClass('current');
        Elem2.addClass('current');
    });

    // $('.next').click(function () {
    //     $('.element1').removeClass('current');
    //     $('.element2').addClass('current');
    // });
    // $('.prev').click(function () {
    //     $('.element2').removeClass('current');
    //     $('.element1').addClass('current');
    // });
});