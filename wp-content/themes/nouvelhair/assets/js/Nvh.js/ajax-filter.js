jQuery(function($) {
  $('.filter-button').on('click', function() {
    var filter = $(this).data('filter');
    var $filteredArticles = $('.filtered-articles');

    $filteredArticles.empty();

    $('.filter-button').removeClass('active');
    $(this).addClass('active');

    $filteredArticles.addClass('loading');

    var ajaxData = {
      action: 'filter_articles',
      filter: filter,
      paged: parseInt($('.pagination .active').text()) || 1,
    };

    if (filter === 'all') {
      ajaxData.filter = '';
    }

    $.ajax({
      url: ajax_params.ajax_url,
      type: 'post',
      data: ajaxData,
      success: function(response) {
        $filteredArticles.html(response);
      },
      complete: function() {
        $filteredArticles.removeClass('loading');
      }
    });
  });

  $('.show-all-button').on('click', function() {
    var $filteredArticles = $('.filtered-articles');

    $('.filter-button').removeClass('active');
    $(this).addClass('active');

    $filteredArticles.empty();
    $filteredArticles.addClass('loading');

    $.ajax({
      url: ajax_params.ajax_url,
      type: 'post',
      data: {
        action: 'filter_articles',
        filter: 'all'
      },
      success: function(response) {
        $filteredArticles.html(response);
      },
      complete: function() {
        $filteredArticles.removeClass('loading');
      }
    });
  });
});
