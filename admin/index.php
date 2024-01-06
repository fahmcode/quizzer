<?php
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/helpers.inc.php';
session_start();

// check if session is there and if loggedIn is true(if not redirect to login page)
if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || $_SESSION['role'] != 'admin'){
  header('Location: ../');
  exit();
}

if(isset($_GET['logout'])){
  logout();
  header('Location: .');
  exit();
}

// admin can: create account
if(isset($_POST['add-user'])){
  // grab the submitted data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  // validate : empty, valid email, valid password
  if(empty($name) or empty($email) or empty($password) or empty($role)){
    $GLOBALS['error'] = 'All fields must be filled';
    include 'add.html.php';
    exit();
  }
  // check if email is valid
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $GLOBALS['error'] = 'The email you entered is invalid';
    include 'add.html.php';
    exit();
  }

  // check if password is at least 8 chars
  if(strlen($password) < 8){
    $GLOBALS['error'] = 'password must be atleast 8 characters';
    include 'add.html.php';
    exit();
  }

  // check if email is in the database
  $sql = "SELECT email FROM `users` WHERE email='$email'";
  $result = mysqli_query($link, $sql);
  if(mysqli_affected_rows($link) > 0){
    $GLOBALS['error'] = 'The user with email alredy exists';
    include 'add.html.php';
    exit();
  }

  // // encrypt password using md5
  $password = password_hash($password, PASSWORD_DEFAULT);

  // store data in the database
  $sql = "INSERT INTO `users`(name, email, password, role) VALUES (?, ?, ?, ?)";
  $stmt= $link->prepare($sql);
  $stmt->bind_param("ssss",$name, $email, $password, $role);
  $result = $stmt->execute();

  if(!$result){
    $GLOBALS['error'] = 'Unable to update user details';
    include 'add.html.php';
    exit();
  }

  $GLOBALS['success'] = "User detail is saved successfully.";
  include 'add.html.php';
  exit();
}


// admin can: update account
if(isset($_POST['edit-user'])){
  // grab the submitted data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $id = $_POST['id'];

  // validate : empty, valid email, valid password
  if(empty($name) or empty($email) or empty($password) or empty($role)){
    $GLOBALS['error'] = 'All fields must be filled';
    include 'edit.html.php';
    exit();
  }
  // check if email is valid
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $GLOBALS['error'] = 'The email you entered is invalid';
    include 'edit.html.php';
    exit();
  }

  // check if password is at least 8 chars
  if(strlen($password) < 8){
    $GLOBALS['error'] = 'password must be atleast 8 characters';
    include 'edit.html.php';
    exit();
  }

  // check if email is in the database
  $sql = "SELECT * FROM `users` WHERE id='$id'";
  $result = mysqli_query($link, $sql);
  if(mysqli_affected_rows($link) != 1){
    $GLOBALS['error'] = 'Unable to get details of the user';
    include 'edit.html.php';
    exit();
  }

  // // encrypt password using md5
  $password = password_hash($password, PASSWORD_DEFAULT);

  // store data in the database
  $sql = "UPDATE `users` SET name='$name', email='$email', password='$password', role='$role' WHERE id=$id";
  $result = mysqli_query($link, $sql);
  if(!$result){
    $GLOBALS['error'] = 'Unable to update user details';
    include 'edit.html.php';
    exit();
  }
  $GLOBALS['success'] = "User detail is updated successfully.";
  include 'edit.html.php';
  exit();
}



// display all the users on the database along with their details
// select all users in the database
// $sql = "SELECT * FROM `users` WHERE NOT role='admin'";
// $result = mysqli_query($link, $sql);
// if(!$result){
//   $GLOBALS['error'] = 'Unable to get users from database';
//   include 'account.html.php';
//   exit();
// }
// while ($row = mysqli_fetch_array($result)) {
//   $users[] = array('id'=>$row['id'], 'name'=>$row['name'], 'email'=>$row['email'], 'role'=>$row['role']);
// }

$users = get_all_users();

if(isset($_POST['action'])){
  if($_POST['action'] == 'add'){
    include 'add.html.php';
    exit();
  }
  if($_POST['action'] == 'edit'){
    if(!isset($_POST['user-id'])){
      $GLOBALS['error'] = "Id is not provided";
      include 'account.html.php';
      exit();
    }
    $id = $_POST['user-id'];
    // get all the details
    $sql = "SELECT * FROM `users` WHERE id='$id'";
    $result = mysqli_query($link, $sql);
    if(!$result){
      $GLOBALS['error'] = "Unable to get the details of the user";
      include 'account.html.php';
      exit();
    }

    while ($row = mysqli_fetch_array($result)) {
      $user = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'email' => $row['email'],
        'role' => $row['role']
      );
    }
    $id = $user['id'];
    $name = $user['name'];
    $email = $user['email'];
    $role = $user['role'];
    include 'edit.html.php';
    exit();
  }
  if($_POST['action'] == 'delete'){
    $id = $_POST['user-id'];
    $sql = "DELETE FROM `users` WHERE id=$id";
    $result = mysqli_query($link, $sql);
    if(!$result){
      $GLOBALS['info'] = 'Could not delete the user from database';
      include 'account.html.php';
      exit();
    }
    $GLOBALS['success'] = 'The user is deleted successfully';
    include 'account.html.php';
    exit();
  }

}


include 'account.html.php';
