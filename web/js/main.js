$(function(){
    $('body').on('click', '#hamburger', function() {
        $('#hamburger').animate({transform: 'rotate(360deg)'});
        $('.block-menu').toggleClass('with--menu');
        $('.container-body').animate({marginTop: '20px'}, 500).animate({marginTop: '0'}, 500);
    });

    $('#show-input-comment-send').on('click', function(e) {
        e.preventDefault();

        $('.writing-comment-and-save').show();
        $('#show-input-comment-send').remove();
    })

    $('#show-input-article-whriting').on('click', function(e) {
        e.preventDefault();

        $('.bloc-article-writing').show();
        $('#show-input-article-whriting').remove();
    })
})