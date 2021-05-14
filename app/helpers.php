<?php

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PWD', '');
define('MYSQL_DB', 'digg');


function dd($data, $die = true){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if( $die ) die;
  }


  function get_footer($page = 'footer'){
    include "tpl/$page.php";
}

function get_header($page = 'header'){
    global $page_title;
    include "tpl/$page.php";
}

function old($fn){
    return $_REQUEST[$fn] ?? '';
}

// Function Make sure the user does not enter an existing email
function email_exist($link, $email){
    $exist = false;
    $sql = "SELECT email FROM users WHERE email = '$email'"; // מחפשת יוזר עם אותו מייל
    $result = mysqli_query($link, $sql);
    
    if( $result && mysqli_num_rows($result) ) {
        $exist = true;
    }
    
    return $exist;
}

// using for name to profile-image 
function str_random($length = 30) {
  
  $characters = '0123456789';
  $characters .= 'abcdefghijklmnopqrstuvwxyz';
  $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  
  $max = strlen($characters) - 1;
  $randomString = '';

  for ($x = 0; $x < $length; $x++) {
    
    $randomString .= $characters[ rand(0, $max) ];
    
  }

  return $randomString;
  
}