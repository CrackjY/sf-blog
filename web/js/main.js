$(function(){
    $('body').on('click', '#hamburger', function() {
        $('.block-menu').toggleClass('with--menu');
        $('.container-body').animate({marginTop: '20px'}, 500).animate({marginTop: '0'}, 500);
    })
})