$(document).ready(function() {
    $('input[type="file"]#picture').click(function () {
        var re = /\.[a-zA-Z0-9]+$/i;
        var result = re.exec($('input[type="file"]').val());
        $('input[type="file"]#picture').next('label').html(result[0]);
    });
})

