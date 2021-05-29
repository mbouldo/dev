<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] . '/utilities/functions.php'; 

$target_dir = '/var/www/testurl001.xyz/public';
$guid = getGUID();

//echo exec('whoami'); 
//chown user destination_dir
//chmod 755 destination_dir


$path = $_FILES['file_upload']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

$target_file = $target_dir . "/img_".$guid.'.'.$ext;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



$uploadOk = 1;

// Check if image file is a actual image or fake image
if(isset($_FILES["file_upload"])) {
  $check = getimagesize($_FILES["file_upload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $message = "wrong_ext";
    $uploadOk = 0;
  }
}

if ($_FILES["file_upload"]["size"] > 5000000) {
    $message = 'too_large';
    $uploadOk = 0;
}

if($ext != "jpg" && $ext != "png" && $ext != "jpeg"
&& $ext != "gif" ) {
  $message = "wrong_ext";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
    $message = 'failed';
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
      $message = 'uploaded';
    } else {
      $message = 'failed';
    }
  }

  $data['message'] = $message;
  $data['guid'] = $guid;

  echo json_encode($data);





?>
