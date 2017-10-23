/**
 * show input comment
 */
$(function() {
    $('body').on('click', '#show-input-comment-send', function (e) {
        e.preventDefault();

        $('.writing-comment-and-save').show();
        $('#show-input-comment-send').remove();
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
