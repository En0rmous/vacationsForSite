$(document).ready(function() {


  
  var VALIDATION_DELAY = 300;
  var validationTimer = null;
  var lastValidationRequest = null;
  var $elems_validated = $([]);
  
  /*
  $('#company_name').on('change', function() {
      $form = $(this).closest('form');
      validationTimer = setTimeout(function () {
          companyRequest = $.ajax({

          }, VALIDATION_DELAY);
      });
  });
*/


  $('form#company-form input,select,textarea').on('keyup change, change, focus, click', function() {
    var $form = $(this).closest('form');
    var $form_for_data = $('form#company-form input, select, textarea');
    $elems_validated = $elems_validated.add($(this));
    clearTimeout(validationTimer);
    var form_data = new FormData();
    $.each($form_for_data, function(index, value) {
      var name = $(value).attr("name");
          if (name.match(/picture/i)) {
              var data = $('[name=' + name + ']').prop('files')[0];
          } else {
              var data = $('[name=' + name + ']').val();
          }
          form_data.append(name, data);
    });
    validationTimer = setTimeout(function() {
      lastValidationRequest = $.ajax({
        url : $form.attr('action'),
        data : form_data,
        processData: false,
        contentType: false,
        type : 'post',
        success : function(response) {
        lastValidationRequest = null;
        var errors = JSON.parse(response);
        console.log(errors);
            $elems_validated.each(function() {
                var name = $(this).attr('name').replace(/\[\d*\]/, '');
          var $elem = $form.find('[name="' + name + '"],[name^="' + name + '["]');
          if (!(name in errors)) {
            $elem.removeClass('is-invalid').addClass('is-valid');
            if ($elem.is('input[type="checkbox"], input[type="radio"]', 'input[type="file"]'))
              $elem = $elem.last().next('label');
            else
              $elem = $(this);
            $elem.next('div.invalid-feedback').remove();
          } else {
          $elem.addClass('is-invalid');
            if ($elem.is('input[type="checkbox"], input[type="radio"]', 'input[type="file"]')) {
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
        if($.isEmptyObject(errors)) {
          // $('#post_company').prop('disabled', false);
        } else {
           //$('#post_company').prop('disabled', true);
        }
        }
      
      });
    }, VALIDATION_DELAY);
  });

  var job_counter = 2;
  var html_template = $('#hidden-template').html();
  $('#name').focus();

    $('#add_job_sign').on('click', function(){
      if(job_counter < 9) {
      var new_template = html_template.replace(/changer/i , job_counter);
      $('#job_row').after().append(new_template);
      job_counter++;
      } else {

      }
    });


    $('#remove_job_sign').on('click', function() {
      if(job_counter > 2) {
        job_counter--;
        $("#job-" + job_counter).parent().remove();
      } else {

      }
    });
    Mousetrap.bind('ctrl+ins', add_job);
    Mousetrap.bind('ctrl+del', remove_job);




function add_job() {
  var add_job = $('#add_job_sign');
  add_job.click();
}
function remove_job() {
  var remove_job = $('#remove_job_sign');
  remove_job.click();
}



});
  


