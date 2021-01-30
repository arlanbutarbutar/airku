$('.page-scroll').on('click', function(){
    var scroll_href=$(this).attr('href');
    var element_href=$(scroll_href);
    $('body').animate({
        scrollTop: element_href.offset().top
    }, 5000, 'swing');
    // e.preventDefault();
});