
<?php include_once 'common.php'; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<div class="container">
<form id="company-form" class="company-form" action="validation_company.php" method="POST" enctype="multipart/form-data">
  <h2 class="text-secondary">Описание компании</h2>
  <div class="company_block">
    <div class="form-group required">
      <label for="company_name">Имя компании</label>
      <input type="text" class="form-control" id="company_name" name="company_name" aria-describedby="company_name_help" placeholder="Введите название компании">
      <small id="company_name_help" class="form-text text-muted">Вводите название компании подразумевая, что после название идет слово "требуется:"</small>
    </div>
    <div class="form-group required">
      <label for="company_site">Ссылка на компанию</label>
      <input type="text" class="form-control" id="company_site" name="company_site" aria-describedby="company_site_help" placeholder="Введите название компании"> 
      <small id="company_site_help" class="form-text text-muted">Укажите ссылку на сайт компании (если конечно она существует)</small>
    </div>
    <div class="form-group required">
      <textarea class="form-control" id="company_about" name="company_about" aria-describedby="company_about_help" placeholder="Введите информацию о компании"></textarea>
      <small id="company_about_help" class="form-text text-muted">Укажите информацию о компании</small>
    </div>
      <div class="form-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="picture" name="picture"  required>
          <label class="custom-file-label" for="picture">Логотип не выбран...</label>
        </div>
      </div>
  </div>
  <button id="post_company" type="submit" class="btn btn-primary"  >Сохранить и перейти к редактированию ваканский</button>
</form>
</div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.2/mousetrap.js" integrity="sha256-XEyThwEhFAauGsuX0hC+bkxvFmY+LhSzE1N1OfOZZZs=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="main.js"></script>
<script src="common.js"></script>


