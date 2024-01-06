<?php

// credentials
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'quizzer';

// $db_host = 'sql304.infinityfree.com';
// $db_user = 'if0_34499312';
// $db_pass = 'CUm1ZxicqtkjB3b';
// $db_name = 'if0_34499312_quizzer';

// the connection itself
$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
// check if connection is succesfull
if(!$link){
  $GLOBALS['error'] = 'Unable to connect to database';
  exit();
}
