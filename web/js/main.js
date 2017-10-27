/**
 * Search Engine effect
 */
$(function () {
   $('body').on('click', '#show-search-engine', function(e) {
       e.preventDefault();
       $('.block-search-engine').show();
       $(this).hide();
   })
});

/**
 * show input comment
 */
$(function() {
    $('body').on('click', '#show-form-comment', function (e) {
        e.preventDefault();

        $('.writing-comment-and-button').show();
        $(this).hide();
    })
});

/**
 * add Tag
 */
$(function () {
    $('body').on('click', '#add-tag', function(e) {
        e.preventDefault();

        var tagContainer = $('#article_tags');
        var tagForm = tagContainer.attr('data-prototype');
        var tagCount = $('.tag-form').length;

        tagForm = tagForm.replace(/__tag__/g, tagCount);

        tagContainer.append(tagForm);
    })
});

/**
 * Delete tag
 */
$(function () {
    $('body').on('click', '#delete-tag', function(e) {
        e.preventDefault();

        $(this).closest('.tag-form').remove();
    })
});

/**
 * update Enable/Disable
 */
$(function () {
    $('body').on('click', '.active-toggle', function(e) {
        e.preventDefault();

        var activeToggle = $(this);
        var route = activeToggle.attr('data-href');

        console.log(route);

        $.ajax({
            url: route,
            success: function (data) {
                console.log(data);
            }
        })
    })
});
