<!doctype html>
<?php include_once 'common.php' ?>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>

    <title>Выезд</title>
</head>

<body>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<div class="container">
<form id="job-form" class="job-form" action="validation_job.php" method="POST" enctype="multipart/form-data">
  <h2>Описание вакансий
    <span>
      <img id="add_job_sign" class="add_job mousetrap" src="./img/window-close.png">
    </span>
    <span id="remove_job_sign">
      <img id="remove_job_sign" class="remove_job" src="./img/window-close.png">
    </span>
  </h2>
  <div class="company_block">
    <div class="row" id="job_row">
      <div class="col-4">
        <div class="card job_card" id="job-1">
          <div class="card-body">
                <div class="form-group required">
                  <label for="job_name_1">Название вакансии</label><br>
                  <input type="text" class="form-control mousetrap" id="job_name" name="job_name" aria-describedby="job_name_help" placeholder="Введите название вакансии">
                </div>
                 <div class="form-group required">
                  <label for="job_link_1">Ссылка на вакансию</label><br>
              <input type="text" class="form-control mousetrap" id="job_link" name="job_link" aria-describedby="job_link_help" placeholder="Введите сслыку на вакансию">
                </div>
      </div>
        </div>
      </div>
    </div>
</div>
  <div id="error-output"></div>
  <button id="send_to_base" type="submit" class="btn btn-primary" >Добавить в базу данных</button>
</form>
</div>


<script id="hidden-template" type="text/x-custom-template">
      <div class="col-4">
        <div class="card job_card" id="job-changer">
          <div class="card-body">
                <div class="form-group required">
                  <label for="job_name_changer">Название вакансии</label><br>
                  <input type="text" class="form-control mousetrap" id="job_name_changer" name="job_name_changer" aria-describedby="job_name_help" placeholder="Введите название вакансии">
                </div>
                 <div class="form-group required">
                  <label for="job_link_changer">Ссылка на вакансию</label><br>
                  <input type="text" class="form-control mousetrap" id="job_link_changer" name="job_link_changer" aria-describedby="job_link_help" placeholder="Введите сслыку на вакансию">
                </div>
          </div>
        </div>
      </div>
</script>


    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.2/mousetrap.js" integrity="sha256-XEyThwEhFAauGsuX0hC+bkxvFmY+LhSzE1N1OfOZZZs=" crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <script src="common.js"></script>
</body>
</html>