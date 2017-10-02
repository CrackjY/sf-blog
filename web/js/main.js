var tagCount = $('#article_tags___tag___name').length;
var tagContainer = $('#article_tags');
var tagForm = tagContainer.attr('data-prototype');

$(function () {
    $('body').on('click', '#show-input-comment-send', function(e) {
        e.preventDefault();

        $('.writing-comment-and-save').show();
        $('#show-input-comment-send').remove();
    })

    $('body').on('click', '#add-tag', function(e) {
        e.preventDefault();

        tagForm = tagForm.replace(/__tag__/g, tagCount);

        tagCount++;

        tagContainer.append(tagForm);
    })
})

$(function () {
    $('body').on('click', '#delete-tag', function (e) {
        e.preventDefault();

    })
})