(function ($, doc) {
    $(doc).ready(function () {
        if (article_id > 0) {
            $.get('/api/article/'+article_id, function (data) {
                if (data && data.id) {
                    $('#article-title').html(data.title);
                    $('#subheader').html(data.subheader);
                    $('#author').html(data.author);
                    $('#date_published').html(data.date_published);
                    $('#article-image').attr('src',data.image);
                    $('#article-content').html(data.content);
                }
            });
            $('#article-more').click(function () {
                $('#article').removeClass('article');
                $('#article').addClass('article-more');
                $('#article-more').remove();
            });
        }
        else { $('#article-more').remove(); }
    });
})(jQuery, document);

