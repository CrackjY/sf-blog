/**
 * Search Engine effect
 */
$(function () {
    $('body').on('click', '#show-search-engine-by-term', function(e) {
        e.preventDefault();

         $('.block-search-term').toggle();
         $(this).hide();
         $('#close-search').show();
         $('#show-search-engine-by-ca').show();
         $('#show-search-engine-by-date').show();
         $('#show-search-engine-advanced').show();
         $('.block-search-ca').hide();
         $('.block-search-date').hide();
    })
});

$(function () {
    $('body').on('click', '#show-search-engine-by-ca', function (e) {
        e.preventDefault();

        $('.block-search-ca').toggle();
        $(this).hide();
        $('#close-search').show();
        $('#show-search-engine-by-term').show();
        $('#show-search-engine-by-date').show();
        $('#show-search-engine-advanced').show();
        $('.block-search-term').hide();
        $('.block-search-date').hide();
        $('#btn-search-by-ca').show();
    })
});

$(function () {
    $('body').on('click', '#show-search-engine-by-date', function(e) {
        e.preventDefault();

        $('.block-search-date').toggle();
        $(this).hide();
        $('#close-search').show();
        $('#show-search-engine-by-term').show();
        $('#show-search-engine-by-ca').show();
        $('#show-search-engine-advanced').show();
        $('.block-search-term').hide();
        $('.block-search-ca').hide();
        $('#btn-search-by-date').show();
    })
});

$(function () {
   $('body').on('click', '#close-search', function(e) {
       e.preventDefault();

       $('#show-search-engine-by-term').show();
       $('#show-search-engine-by-ca').show();
       $('#show-search-engine-by-date').show();
       $('#show-search-engine-advanced').show();
       $('.block-search-term').hide();
       $('.block-search-ca').hide();
       $('.block-search-date').hide();
       $('#btn-search-by-date').hide();
       $(this).hide();
   })
});
