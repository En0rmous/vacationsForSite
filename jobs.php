<?
	include_once 'common.php';

	$path = 'jobs.csv';
	$fh = fopen($path, 'r');

	//Массив компаний 
	$companies = array();


	$headers = getcsv($fh, 0, CSV_DELIM);

	//Читаем файл и заносим в массив компании
	while (!feof($fh)) {
	  $data = getcsv($fh, 0, CSV_DELIM);


//Если пустая строка в csv то заноси к той же компании
  if(!empty($data[COL_COMPANY_NAME])){
    //variable COMPANY
    //Общие черты компании, но из работы мы тоже их получить можем
    $c = new Company();
    $c->name = trim($data[COL_COMPANY_NAME]);
    $c->company_about = trim($data[COL_COMPANY_ABOUT]);
    $c->company_site = trim($data[COL_COMPANY_SITE]);
    $c->company_time = trim($data[COL_COMPANY_TIME]);
    //Картинка компании всегда LOGO.PNG
    $c->picture = "companies/".$c->name."/"."logo.png";   
  }
  $j = new Job();
  $j->company = $c;
  if (preg_match("/^https?:\/\//", $data[COL_COMPANY_JOB_PAGE])){
    $j->job_link = $data[COL_COMPANY_JOB_PAGE];
  } else {
      $j->job_link = "/for-students/employment/jobs/companies/".$c->name."/".$data[COL_COMPANY_JOB_PAGE];
  }
  $j->job_name = $data[COL_COMPANY_JOB_NAME];
  $c->jobs[] = $j; //INPUT TO COMPANY JOB ARRAY

    if(!empty($data[COL_COMPANY_NAME])){
    $companies[] = $c;//Массив компаний
    }
  }
//Делаем реверсе, чтобы отобразить свежак так как в csv файле вакансии заносятся в конец
$companies = array_reverse($companies);

	?>
	<link rel="stylesheet" type="text/css" href="/for-entrants/libs/colorbox/example5/colorbox.css" />

	<script type="text/javascript">
	  $(document).ready(function(){
			$('.sidecenter .text img').each(
				function(){
					var src = $(this).attr("src");
					$(this).unwrap();
				}
			);
		$('a#help-link').colorbox();
		});
	</script>

	<!-- Отображение вакансий на сайте -->

	<h2 class="title"><?php echo $page_title; ?></h2>
	<div class="sidecenter"><hr></div>
	<table class="table">
	  <tbody>
	  <? foreach ($companies as $c) : ?>
		<?php echo print_companyNew($c); ?>
	  <? endforeach; ?>
	  </tbody>
	</table>
   <link rel="stylesheet" href="style.css"> 


