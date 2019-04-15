$(document).ready(function() {


  var VALIDATION_DELAY = 300;
  var validationTimer = null;
  var lastValidationRequest = null;
  var $elems_validated = $([]);
  $('form.ajax input,select,textarea').not('input[type="file"]').on('keyup change', function() {
    var $form = $(this).closest('form');
    $elems_validated = $elems_validated.add($(this));
    clearTimeout(validationTimer);
    validationTimer = setTimeout(function() {
      lastValidationRequest = $.ajax(
        url: $form.attr('action'),
        type: "POST",
        data: $form.serialize() + '&validate=1',
        processData: false,
        success: function(response) {
        lastValidationRequest = null;
        var errors = JSON.parse(response);
        console.log(errors);
        $elems_validated.each(function() {
          var name = $(this).attr('name').replace(/\[\d*\]/, '');
          var $elem = $form.find('[name="' + name + '"],[name^="' + name + '["]');
          if (!(name in errors)) {
            $elem.removeClass('is-invalid').addClass('is-valid');
            if ($elem.is('input[type="checkbox"], input[type="radio"]'))
              $elem = $elem.last().next('label');
            else
              $elem = $(this);
            $elem.next('div.invalid-feedback').remove();
          } else {
            $elem.addClass('is-invalid');
            if ($elem.is('input[type="checkbox"], input[type="radio"]')) {
              $elem = $elem.last().next('label');
            }
            $elem.next('div.invalid-feedback').remove();
            var html = '';
            if (errors[name].length > 1) {
              var html = '<ul>';
              for (var i = 0; i < errors[name].length; i++)
                html += '<li>' + errors[name][i] + '</li>';
              html += '</ul>';
            } else {
              html = errors[name][0];
            }
            $elem.after('<div class="invalid-feedback">' + html + '</div>');
          }
          $elems_validated = $elems_validated.not($(this));
        });
        if (errors.length === 0)
          $form.find('button[type="submit"]').prop('disabled', false);
        else
          $form.find('button[type="submit"]').prop('disabled', true);
      });
    }, VALIDATION_DELAY);
  });

});
  


