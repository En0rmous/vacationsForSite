<?php

  use Respect\Validation\Validator as v;
  use Respect\Validation\Exceptions\NestedValidationException;
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use Doctrine\Common\ClassLoader;
  use Doctrine\ORM\Tools\Setup;
  use Doctrine\ORM\EntityManager;

  //Поменть под сайт
  //------------------
  define('BASE_DIR',dirname(dirname(__FILE__)));
  //define('BASE_URL', '/public'); // localhost
  //define('BASE_URL', '/for-entrants'); // stankin.ru
  define('LIBS_DIR', BASE_DIR . '/ComposerLibs');
  //define('LIBS_URL', BASE_DIR  . '/libs_new/vendor');
  //------------------

  include_once LIBS_DIR . '/vendor/autoload.php';
  include_once LIBS_DIR . '/vendor/respect/validation/library/Validator.php';
  require LIBS_DIR . '/vendor/phpmailer/phpmailer/src/Exception.php';
  require LIBS_DIR . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
  require LIBS_DIR . '/vendor/phpmailer/phpmailer/src/SMTP.php';

    
    define('CSV_DELIM', ';');
	define('COL_COMPANY_NAME', 0);
	define('COL_COMPANY_ABOUT',1);
	define('COL_COMPANY_SITE',2);
	define('COL_COMPANY_JOB_NAME',3);
	define('COL_COMPANY_JOB_PAGE',4);
	define('COL_COMPANY_TIME',5);
	define('VACANCY_TAG','#VACANCY#');




class Company {
	  public $company_name;
	  public $company_site;
	  public $company_about;
      public $picture;
	  public $jobs;
	  public $company_time;
	}

	class Job {
	  public $company;
	  public $job_name;
	  public $job_link;
	}
  
  function decode($str) {
	  return iconv( "Windows-1251", "UTF-8", $str );
	}

	function getcsv($fh) {
	  $data = fgetcsv($fh, 0, CSV_DELIM);
	  return is_array($data) ? array_map('decode', $data) : $data;
	}
  
  function print_companyNew(Company $c) {
    $html = '';
$company_tpl = file_get_contents('company-tpl.html');
    
    $html = str_replace('#NAME#', $c->company_name, $company_tpl);
    $html = str_replace('#COMPANY_URL#', $c->company_site, $html);
    
    if(file_exists($c->picture)) {
        $html = str_replace('#PICTURE#', $c->picture, $html);
    } else {
      $html = str_replace('#PICTURE#', "/for-students/employment/jobs/missing.png", $html);
    }
    $html = str_replace('#NAME#', $c->company_name, $html);
    $html = str_replace('#ABOUT_COMPANY#', $c->company_about, $html);
    $html = str_replace('#VACANCY_DATA#', $c->company_time, $html);
    if(!empty($c->company_about)) {
      $html = str_replace('#TEXT_ABOUT_COMPANY#', "О компании:", $html);	
    } else {
      $html = str_replace('#TEXT_ABOUT_COMPANY#', "", $html);  
    }
    
    $ul_job_html = "";
    // Для каждой компании определи работы
    foreach ($c->jobs as $job) {
      $li_job_tpl = "<li><a href={$job->job_link}>{$job->job_name}</a></li>";
      $ul_job_html .= $li_job_tpl;
    }
    $html = str_replace('#VACANCY#', $ul_job_html, $html);

    return $html;
  }

function dbConnection() {
    $dbparams = array (
        'host' => 'localhost',
        'dbname' => 'practice',
        'username' => 'root',
        'password' => ''
    );

    return $conn = new PDO("mysql:host=" . $dbparams['host'] . "; dbname=" . $dbparams['dbname'] . ";" , $dbparams['username'], $dbparams['password']);
}

function dbSelectLikeCompany(Company $c) {
    $like_company = '';
    $conn = dbConnection();
    $sql = "Select company_id, company_name from Company WHERE company_name like '%" . $c->company_name . "%'";
    while($result = $conn->query($sql)->fetch()) {
        $like_company .= $result['company_name'] . '&';
    }
    echo $like_company;
}



  function translate($message) {
  $translations = array(
    '{{name}} must not be empty'
    => '{{name}} Поле обязательно для заполнения',
    '{{name}} must have a length between {{minValue}} and {{maxValue}}'
    => '{{name}} Длина должна быть не менее {{minValue}} и не более {{maxValue}}',
    '{{name}} must validate against {{regex}}'
    => '{{name}} Недопустимое значение',
    '{{name}} must be in {{haystack}}'
    => '{{name}} Допустимые значения: {{haystack}}',
    '{{name}} must be an integer number'
    => '{{name}} Допускаются только целые числа',
    '{{name}} must be greater than or equal to {{interval}}'
    => '{{name}} Значение должно быть больше или равно {{interval}}',
    '{{name}} must have a length lower than {{maxValue}}'
    => '{{name}} Максимальная длина {{maxValue}} символов',
    '{{name}} must have a length greater than {{minValue}}'
    => '{{name}} Минимальная длина {{minValue}} символов',
    '{{name}} must be less than or equal to {{interval}}'
    => '{{name}} Значение должно быть меньше или равно {{interval}}',
    '{{name}} must be a valid date. Sample format: {{format}}'
    => '{{name}} Неверный формат даты. Пример: {{format}}',
    '{{name}} must be between {{minAge}} and {{maxAge}} years ago'
    => '{{name}} Допускаются значения от {{minAge}} до {{maxAge}} лет назад',
    '{{name}} must be between {{minValue}} and {{maxValue}}'
    => '{{name}} Допускаются значения от {{minValue}} до {{maxValue}}',
    '{{name}} must be valid email'
    => '{{name}} Неверный формат электронной почты',
	'{{name}} must be a valid date'
	=> '{{name}} Неверный формат даты',
	'{{name}} must be positive'
	=> '{{name}} Допускаются только положительные числа',
	'{{name}} must be numeric'
	=>'Допускаются только числа'
  );
  return isset($translations[$message])?
    $translations[$message] :
    $message;
}
?>