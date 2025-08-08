jQuery(document).ready(function($) {
  function loadArticles(range) {
    $.post(mva_ajax.ajax_url, {
      action: 'get_most_viewed_articles',
      range: range
    }, function(response) {
      $('.mva-content').html(response);
    });
  }

  loadArticles('week');

  $(document).on('click', '.mva-tab', function() {
    $('.mva-tab').removeClass('active');
    $(this).addClass('active');
    loadArticles($(this).data('range'));
  });
});
