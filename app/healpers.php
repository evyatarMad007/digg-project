<?php

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PWD', '');
define('MYSQL_DB', 'digg');

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