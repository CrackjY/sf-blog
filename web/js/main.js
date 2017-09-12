$(function(){
    $('body').on('click', '#hamburger', function() {
        $('#hamburger').animate({transform: 'rotate(360deg)'});
        $('.block-menu').toggleClass('with--menu');
        $('.container-body').animate({marginTop: '20px'}, 500).animate({marginTop: '0'}, 500);
    })
})