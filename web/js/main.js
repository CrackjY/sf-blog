/**
 * add tag
 */
$(function() {

    $('body').on('click', '#show-input-comment-send', function(e) {
        e.preventDefault();

        $('.writing-comment-and-save').show();
        $('#show-input-comment-send').remove();
    });

    $('body').on('click', '#add-tag', function(e) {
        e.preventDefault();

        var tagContainer = $('#article_tags');
        var tagForm = tagContainer.attr('data-prototype');
        var tagCount = $('.tag-form').length;

        tagForm = tagForm.replace(/__tag__/g, tagCount);

        tagContainer.append(tagForm);
    });

    /**
     * Delete tag
     */
    $('body').on('click', '#delete-tag', function(e) {
        e.preventDefault();

        $(this).closest('.tag-form').remove();
    })
});