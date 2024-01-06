<?php
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/helpers.inc.php';
session_start();
// check if session is there and if loggedIn is true(if not redirect to login page)
if(!isset($_SESSION['loggedIn']) or !$_SESSION['loggedIn'] || $_SESSION['role'] != 'committee'){
  header('Location: ../');
  exit();
}

if(isset($_GET['logout'])){
  logout();
  header('Location: .');
  exit();
}

if(isset($_POST['action'])){
  if($_POST['action'] == 'approve-exam'){
    $examid = $_POST['examid'];
    $sql = "UPDATE exams SET status='approved' WHERE id=$examid";
    if(!mysqli_query($link, $sql)){
      $GLOBALS['error'] = 'Did not approve the exam';
      $exams = get_pending_exams();
      include 'exams.html.php';
      exit();
    }
    $GLOBALS['success'] = 'Approved exam successfully.';
    $exams = get_pending_exams();
    include 'exams.html.php';
    exit();
  }

  if($_POST['action'] == 'disapprove-exam'){
    $examid = $_POST['examid'];
    $sql = "UPDATE exams SET status='created' WHERE id=$examid";
    if(!mysqli_query($link, $sql)){
      $GLOBALS['error'] = 'Did not disapprove the exam';
      $exams = get_pending_exams();
      include 'exams.html.php';
      exit();
  }
  $GLOBALS['success'] = 'Disapproved exam successfully.';
  $exams = get_pending_exams();
  include 'exams.html.php';
  exit();
}
}

$exams = get_pending_exams();
include 'exams.html.php';
