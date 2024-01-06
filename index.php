<?php
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/helpers.inc.php';
session_start();

// If user is logged in redirect to appropriate page
if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn']){
  if(isset($_SESSION['role']) and $_SESSION['role'] == 'admin'){
    header("Location: ./admin");
    exit();
  }

  if(isset($_SESSION['role']) and $_SESSION['role'] == 'teacher'){
    header("Location: ./teacher");
    exit();
  }

  if(isset($_SESSION['role']) and $_SESSION['role'] == 'committee'){
    header("Location: ./committee");
    exit();
  }

  if(isset($_SESSION['role']) and $_SESSION['role'] == 'student'){
    header("Location: ./student");
    exit();
  }

}


// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


//user submitted login form(Save the data to database)
if(isset($_POST['login-user'])){
  // grab the submitted data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // check if all fields are filled
  if(empty($email) || empty($password)){
    $GLOBALS['error'] = 'All fields must be filled';
    include 'login.html.php';
    exit();
  }

  // check if email is valid
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $GLOBALS['error'] = 'The email you entered is invalid';
    include 'login.html.php';
    exit();
  }

  // check if password is at least 8 chars
  if(strlen($password) < 8){
    $GLOBALS['error'] = 'password must be atleast 8 characters';
    include 'login.html.php';
    exit();
  }
  // // encrypt password using md5
  // $password = password_hash($password, PASSWORD_DEFAULT);

  // check if email is in the database
  $sql = "SELECT * FROM `users` WHERE email='$email'";
  $result = mysqli_query($link, $sql);
  if(mysqli_affected_rows($link) == 0){
    $GLOBALS['error'] = 'Wrong email or/and password';
    include 'login.html.php';
    exit();
  }

  // get the details
  while ($row = mysqli_fetch_array($result)) {
    $user = array(
                  'id' => $row['id'],
                  'name' => $row['name'],
                  'email' => $row['email'],
                  'password' => $row['password'],
                  'role' => $row['role'],
                );
  }

  // compare credentials
  if($user['email'] != $email){
    $GLOBALS['error'] = 'Wrong email or/and password';
    include 'login.html.php';
    exit();
  }
  if(!password_verify($password, $user['password'])){
    $GLOBALS['error'] = 'Wrong email or/and password';
    include 'login.html.php';
    exit();
  }

  // start a session and store details in session:
  $_SESSION['id'] = $user['id'];
  $_SESSION['name'] = $user['name'];
  $_SESSION['email'] = $user['email'];
  $_SESSION['role'] = $user['role'];
  $_SESSION['loggedIn'] = TRUE;

  // redirect to appropriate page
  header('Location: .');
  exit();
}


// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


//user submitted reset password form
if(isset($_POST['reset-password'])){
  $email = $_POST['email'];
  $new_password = $_POST['new-password'];
  $new_password_confirm = $_POST['new-password-confirm'];
  // check if email is Empty
  if(empty($email) or empty($new_password) or empty($new_password_confirm)){
    $GLOBALS['error'] = 'Please, fill all the fields.';
    include 'forgot.html.php';
    exit();
  }

  // check if email is valid
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $GLOBALS['error'] = 'The email you entered is invalid';
    include 'forgot.html.php';
    exit();
  }

  // check if password is at least 8 chars
  if(strlen($new_password) < 8 or strlen($new_password_confirm) < 8){
    $GLOBALS['error'] = 'passwords must be atleast 8 characters';
    include 'forgot.html.php';
    exit();
  }

  // check if email is in the database
  $sql = "SELECT id, email, password FROM `users` WHERE email='$email'";
  $result = mysqli_query($link, $sql);
  if(mysqli_affected_rows($link) == 0){
    $GLOBALS['error'] = 'No active account with this emal address, try to talk to app administrator';
    include 'forgot.html.php';
    exit();
  }

  // get the details
  while ($row = mysqli_fetch_array($result)) {
    $user = array(
                  'id' => $row['id'],
                  'email' => $row['email'],
                  'password' => $row['password'],
                );
  }
  $password = password_hash($new_password, PASSWORD_DEFAULT);
  // update the password in db

  $sql = "UPDATE users SET  password=? WHERE id=? AND email=?";
  $stmt= $link->prepare($sql);
  $stmt->bind_param("sis", $password, $user['id'], $user['email']);
  $stmt->execute();


  if(mysqli_affected_rows($link) == 0){
    $GLOBALS['error'] = 'Unable to change password';
    include 'forgot.html.php';
    exit();
  }

  $GLOBALS['success'] = 'Your password changed successfully.';
  include 'forgot.html.php';
  exit();

}

// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


// User wants to view login page
if(isset($_GET['login'])){
  include 'login.html.php';
  exit();
}

// User wants to view forgot page
if(isset($_GET['forgot'])){
  include 'forgot.html.php';
  exit();
}



include 'login.html.php';
