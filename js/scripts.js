(function($) {

  $('#save-task').on('submit', function(e) {

    $.ajax({
      url: 'services/insertTask',
      type: 'POST',
      data: $('#title').val(),
      success: function(data){
        console.log(data);
      },
    });

    e.preventDefault();
  });

})(jQuery);
