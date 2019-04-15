<?php
  include_once 'common.php';
  include_once LIBS_DIR . '/composer/vendor/respect/validation/library/Validator.php';
  use Respect\Validation\Validator as v;
  use Respect\Validation\Exceptions\NestedValidationException;
  define('BASE_DIR_UPLOAD', dirname(__FILE__));
  $errors = array();
  $c = new Company();

  /*
  if(file_exists($_FILES['picture']['tmp_name'])) {
    $uploaddir = BASE_DIR_UPLOAD . '/companies/' . $c->company_name;
    if(file_exists($uploaddir . "/logo.png")) {
      unlink($uploaddir . "/logo.png");
      rmdir($uploaddir);
    }
    mkdir($uploaddir, 0777, true);
    $uploadfile = BASE_DIR_UPLOAD . '/companies/' . $c->company_name  . $_FILES['picture']['name'];
    if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
      $c->picture = $uploadfile;
      //rename($uploadfile, $uploaddir . "/logo.png");
    }
  } else {
    $c->picture = '';
  }
*/



  foreach ($_POST as $key => $val) {
        $c->$key = $val;
        echo $key;
    }

   if(file_exists($_FILES['picture']['tmp_name'])){
    $c->picture = $_FILES['picture']['tmp_name'];
   }


	$requestValidator =
      v::attribute('company_name', v::regex('/^[\p{L}\s«».]{4,255}$/ui'))
      ->attribute('company_site', v::oneOf(v::not(v::notEmpty()), v::regex('/^https?:\/\/[\p{L}\.-]{1,55}$/ui')))
      ->attribute('company_about', v::stringType()->length(null,255)->regex('/^[\p{L}\s\«\»\.\:]+$/ui'))
      ->attribute('picture',  v::image());
      //->attribute('job_name', v::stringType()->notEmpty()->length(1,50)->regex('/^[\p{L}\s\«\»\.]+$/ui'))
      //->attribute('job_link', v::stringType()->length(7, 50)->regex('/^https?:/ui'));

  try {
    $requestValidator->assert($c);
    $message = new stdClass();
    echo json_encode($message);
    exit;
  } catch (NestedValidationException $exception) {
   // $exception->setParam('translator', 'translate');
    $messages = $exception->getMessages();
    foreach ($messages as $m) {
      if (preg_match("/^([^\s]+)\s/", $m, $matches)) {
        $word1 = $matches[1];
        if (property_exists('Company', $word1)) {
          if (!isset($errors[$word1])) $errors[$word1] = array();
          $errors[$word1][] = str_replace("$word1 ", '', $m);
        }
      }
    }
    echo json_encode($errors);
}



?>
