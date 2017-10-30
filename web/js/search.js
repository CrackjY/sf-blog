/**
 * Search Engine effect
 */
$(function () {
    $('body').on('click', '#show-search-engine-by-term', function(e) {
        e.preventDefault();

        $(this).hide();
        $('.block-search-term').toggle();
        $('#show-search-engine-by-ca').show();
        $('#close-search').show();
        $('.block-search-ca').hide();
        $('.block-search-date').hide();
    })
});

$(function () {
    $('body').on('click', '#show-search-engine-by-ca', function (e) {
        e.preventDefault();

        $(this).hide();
        $('.block-search-ca').toggle();
        $('#close-search').show();
        $('#show-search-engine-by-term').show();
        $('#show-search-engine-by-date').show();
        $('#btn-search-by-ca').show();
        $('.block-search-term').hide();
        $('.block-search-date').hide();
    })
});

$(function () {
    $('body').on('click', '#show-search-engine-by-date', function(e) {
        e.preventDefault();

        $(this).hide();
        $('.block-search-date').toggle();
        $('#show-search-engine-by-term').show();
        $('#show-search-engine-by-ca').show();
        $('#show-search-engine-advanced').show();
        $('#btn-search-by-date').show();
        $('#close-search').show();
        $('.block-search-term').hide();
        $('.block-search-ca').hide();
    })
});

$(function () {
   $('body').on('click', '#close-search', function(e) {
       e.preventDefault();

       $(this).hide();
       $('#show-search-engine-by-term').show();
       $('#show-search-engine-by-ca').show();
       $('#show-search-engine-by-date').show();
       $('.block-search-term').hide();
       $('.block-search-ca').hide();
       $('.block-search-date').hide();
   })
});
