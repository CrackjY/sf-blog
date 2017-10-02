$(function () {
    $('body').on('click', '#show-input-comment-send', function(e) {
        e.preventDefault();

        $('.writing-comment-and-save').show();
        $('#show-input-comment-send').remove();
    })

    var tagCount = $('#article_tags___tag___name').length;

    $('body').on('click', '#add-tag', function(e) {
        e.preventDefault();

        var tagContainer = $('#article_tags');
        var tagForm = tagContainer.attr('data-prototype');

        tagForm = tagForm.replace(/__tag__/g, tagCount);

        tagCount++;

        tagContainer.append(tagForm);
    })

    $('body').on('click', '#delete-tag', function (e) {
        e.preventDefault();
    })
});
