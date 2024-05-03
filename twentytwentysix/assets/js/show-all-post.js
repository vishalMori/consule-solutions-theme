jQuery(document).ready(function ($) {
  let page = 1;
  $('#load-all-btn').click(function (e) {
    e.preventDefault();
    page++;
    $.ajax({
      url: ajax_object.ajaxurl,
      type: 'POST',
      data: {
        action: 'show_all_post',
        page_number: page,
      },
      success: function (response) {
        console.log(response);
        $('#row-list-two').append(response);
        $('#load-all-btn').hide();
      },
    });
    
  });
});