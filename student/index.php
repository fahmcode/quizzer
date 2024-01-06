<?php
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/helpers.inc.php';
session_start();
// check if session is there and if loggedIn is true(if not redirect to login page)
if(!isset($_SESSION['loggedIn']) or !$_SESSION['loggedIn'] || $_SESSION['role'] != 'student'){
  header('Location: ../');
  exit();
}

if(isset($_GET['logout'])){
  logout();
  header('Location: .');
  exit();
}

if(isset($_POST['link'])){
    // Link to start exam
    if($_POST['link'] == 'start'){
      $examid = $_POST['examid'];
      $exam = get_exam_detail($examid);
      $ques_num = get_ques_num($examid);
      if($ques_num > 0){
        $_SESSION["exam_status"] = 'running';
        $_SESSION['exam_id'] = $examid;
        $_SESSION['currId'] = 0;
        $_SESSION['score'] = 0;
        $_SESSION['ques_num'] = $ques_num;

        $questions = get_questions($_SESSION['exam_id']);
        $question = $questions[$_SESSION['currId']];
        include 'questions.html.php';
        exit();
      }else{
        $questions = get_questions($examid);
        include 'questions.html.php';
        exit();
      }
    }

      // link to get next quetion
  if($_POST['link'] == 'next'){
    // get submitted option
    $questionid = $_POST['questionid'];
    $optionid = $_POST['options'];
    $option = get_option_by_id($optionid);
    if($option['iscorrect'] == 1){
      $_SESSION['score']++;
    }
    $_SESSION['currId']++;
    $questions = get_questions($_SESSION['exam_id']);
    $question = $questions[$_SESSION['currId']];
    include 'questions.html.php';
    exit();
  }

  // link to get next quetion
  if($_POST['link'] == 'finish'){
    // get submitted option
    $questionid = $_POST['questionid'];
    $optionid = $_POST['options'];
    $option = get_option_by_id($optionid);
    if($option['iscorrect'] == 1){
      $_SESSION['score']++;
    }

    $examid = $_SESSION['exam_id'];
    $score = $_SESSION['score'];
    $userid = $_SESSION['id'];
    // store the score in db
    $sql = "INSERT INTO results( userid, examid, score) VALUES ($userid, $examid, $score)";
    if(!mysqli_query($link, $sql)){
      $GLOBALS['error'] = 'Your results could not be saved';
      $exams = get_exam_by_user($_SESSION['id']);
      $completed = get_completed_exams_by_user($_SESSION['id']);
      include 'exam.html.php';
      exit();
    }
    // change status of exam to completed
    $sql = "UPDATE exams SET status = 'completed' WHERE id = $examid";
    if(!mysqli_query($link, $sql)){
      $GLOBALS['error'] = 'Exam status could not be changed';
      $exams = get_exam_by_user($_SESSION['id']);
      $completed = get_completed_exams_by_user($_SESSION['id']);
      include 'exam.html.php';
      exit();
    }
    // unset all session for exam
    unset($_SESSION["exam_status"]);
    unset($_SESSION['exam_id']);
    unset($_SESSION['currId']);
    unset($_SESSION['score']);
    unset($_SESSION['ques_num']);
    // extract result from database
    $GLOBALS['Success'] = 'You have finished exam successfully, Wait for approval to view results';
    $exams = get_exam_by_user($_SESSION['id']);
    $completed = get_completed_exams_by_user($_SESSION['id']);
    include 'exam.html.php';
    exit();
  }

    // Link to end questions
  if($_POST['link'] == 'questions'){
    $examid = $_POST['exam-id'];
    // get exam details
    $questions = get_questions($examid);
    include 'questions.html.php';
    exit();
  }
}

if(isset($_POST['action'])){
  if($_POST['action'] == 'see-result'){
    $examid = $_POST['examid'];
    $userid = $_SESSION['id'];

    $exam = get_exam_detail($examid);
    $result = get_user_result($userid, $examid);
    include 'results.html.php';
    exit();
  }
}


$exams = get_exam_by_user($_SESSION['id']);
$completed = get_completed_exams_by_user($_SESSION['id']);
include 'exam.html.php';
