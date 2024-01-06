<?php
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/helpers.inc.php';
session_start();
// check if session is there and if loggedIn is true(if not redirect to login page)
// Tacher can: Add an exam
// Tacher can: Check an exam
// Tacher can: recieve notification
// Tacher can: send notification
if(!isset($_SESSION['loggedIn']) or !$_SESSION['loggedIn'] || $_SESSION['role'] != 'teacher'){
  header('Location: ../');
  exit();
}

if(isset($_GET['logout'])){
  logout();
  header('Location: .');
  exit();
}


// links are used to go to some page
if(isset($_POST['link'])){
  // for adding exam
  if($_POST['link'] == 'add-exam'){
    include 'add.html.php';
    exit();
  }

  // for checking exam
  if($_POST['link'] == 'assign-exam'){
    $examid = $_POST['examid'];
    $exam = get_exam_detail($examid);
    $users = get_users();
    $GLOBALS['info'] = 'Assign exam for exam with id=' . $examid ;
    include 'assign.html.php';
    exit();
  }

  // for viewing exam details
  if($_POST['link'] == 'view-exam'){
    $exam_id = $_POST['examid'];
    // now grab the details from db
    $exam = get_exam_detail($exam_id);
    // grab all the questions from the database
    $questions = get_questions($exam_id);
    $GLOBALS['info'] = 'View exam details for exam with id=' . $exam_id;
    include 'view.html.php';
    exit();
  }

  // Add question link
  if($_POST['link'] == 'add-question'){
    $exam_id = $_POST['examid'];
    $exam = get_exam_detail($exam_id);
    $GLOBALS['info'] = 'Add question for exam with id=' . $exam_id;
    include 'add_question.html.php';
    exit();
  }

  // Add question link
  if($_POST['link'] == 'add-options'){
    $examid = $_POST['examid'];
    $questionid = $_POST['questionid'];
    $exam = get_exam_detail($examid);
    $question = get_question_detail($questionid);
    $GLOBALS['info'] = 'Add options for exam with id=' . $examid . ' and question id=' . $questionid;
    include 'add_options.html.php';
    exit();
  }

}

// actions are for taking actions
if(isset($_POST['action'])){
    // send exam to committee
    if($_POST['action'] == 'send-exam'){
      $examid = $_POST['examid'];
      $sql = "UPDATE exams SET status = 'pending' WHERE id=$examid";
      if(!mysqli_query($link, $sql)){
        $GLOBALS['error'] = 'Did not send exam to committee.';
        $exams = get_created_exams();
        $completed = get_completed_exams();
        include "exam.html.php";
      }
      $GLOBALS['success'] = 'Sent to committee successfully.';
      $exams = get_created_exams();
      $completed = get_completed_exams();
      include "exam.html.php";
      exit();
    }

    if($_POST['action'] == 'submit-result'){
      $examid = $_POST['examid'];
      $sql = "UPDATE results SET status = 1 WHERE examid=$examid";
      if(!mysqli_query($link, $sql)){
        $GLOBALS['error'] = 'Did not submit result.';
        $exams = get_created_exams();
        $completed = get_completed_exams();
        include "exam.html.php";
      }
      $GLOBALS['success'] = 'Submitted result successfully.';
      $exams = get_created_exams();
      $completed = get_completed_exams();
      include "exam.html.php";
      exit();
    }

    // assign student
    if($_POST['action'] == 'assign'){
      $examid = $_POST['examid'];
      $users = $_POST['users'];
      foreach ($users as $user) {
        $sql = "INSERT INTO userexam (userid, examid) VALUES ($user, $examid)";
        mysqli_query($link, $sql);
      }
      $GLOBALS['success'] = 'Assigned students to exam successfully';
      $exams = get_created_exams();
      $completed = get_completed_exams();
      include "exam.html.php";
      exit();
    }

  if($_POST['action'] == 'add-exam'){
    // grab the data
    $title = $_POST['title'];
    $created_date = $_POST['created_date'];
    $scheduled_date = $_POST['scheduled_date'];
    $status = $_POST['status'];
    $pass_mark = $_POST['pass_mark'];

    // check if all are filled
    if(empty($title) or empty($created_date) or empty($scheduled_date) or empty($status) or empty($pass_mark)){
      $GLOBALS['error'] = 'All fields must be filled';
      include 'add.html.php';
      exit();
    }

    // store the data in db
    $sql = "INSERT INTO
                      `exams`(`title`, `created_date`, `scheduled_date`, `pass_mark`, `status`)
                      VALUES ('$title', '$created_date', '$scheduled_date', '$pass_mark', '$status')";
    $result = mysqli_query($link, $sql);
    if(!$result){
      $GLOBALS['error'] = 'Unable to insert data into database.';
      include 'add.html.php';
      exit();
    }

    $GLOBALS['success'] = "The new exam item is inserted in database successfully";
    include 'add.html.php';
    exit();
  }

    // Add question
    if($_POST['action'] == 'add-question'){
      $title = $_POST['title'];
      $weight = $_POST['weight'];
      $examid = $_POST['examid'];
      $sql = "INSERT INTO questions (title, weight, examid) VALUES ('$title', $weight, $examid)";
      if(!mysqli_query($link, $sql)){
        $GLOBALS['error'] = 'Unable to insert question into database.';
        $exam = get_exam_detail($examid);
        $questions = get_questions($examid);
        include 'view.html.php';
        exit();
      }
      $GLOBALS['success'] = 'Successfully inserted question into database.';
      $exam = get_exam_detail($examid);
      $questions = get_questions($examid);
      $ques_num = get_ques_num($examid);
      include 'view.html.php';
      exit();
    }

    if($_POST['action'] == 'add-options'){
      $examid = $_POST['examid'];
      $questionid = $_POST['questionid'];
      $option1 = $_POST['option1'];
      $option2 = $_POST['option2'];
      $option3 = $_POST['option3'];
      $option4 = $_POST['option4'];

      $correct1 = 0;
      $correct2 = 0;
      $correct3 = 0;
      $correct4 = 0;
      $answer = $_POST['correct'];

      if($answer == 1){
        $correct1 = 1;
      }elseif($answer == 2) {
        $correct2 = 1;
      }elseif($answer == 3) {
        $correct3 = 1;
      }elseif($answer == 4){
        $correct4 = 1;
      }else{
        $correct1 = 1;
      }



      $sql = "INSERT INTO options (title, isCorrect, questionid) VALUES
                          ('$option1', $correct1, $questionid),
                          ('$option2', $correct2, $questionid),
                          ('$option3', $correct3, $questionid),
                          ('$option4', $correct4, $questionid)";
      if(!mysqli_query($link, $sql)){
        $GLOBALS['error'] = "Did not insert options";
        exit();
      }
      $exam = get_exam_detail($examid);
      $questions = get_questions($examid);
      $ques_num = get_ques_num($examid);
      include 'view.html.php';
      exit();
    }

  // for deleting exam
  if($_POST['action'] == 'delete-exam'){
    $examid = $_POST['examid'];
    // get all question associated.
    if($questions = get_questions($examid)){
      // delete all options for each of the questions
      foreach($questions as $question){
        $questionid = $question['id'];
        // delete if there are options associated.
        if($options = get_options($questionid)){
          $sql = "DELETE FROM options WHERE questionid = $questionid";
          if(!mysqli_query($link, $sql)){
            $GLOBALS['error'] = "Unable to delete options";
            exit();
          }
        }
      }
      // delete all questions associated with this exam.
      $sql = "DELETE FROM questions WHERE examid = $examid";
      if(!mysqli_query($link, $sql)){
        $GLOBALS['error'] = "Unable to delete questions";
        exit();
      }
    }

    // delete all references to user and exam from user exam database
    $sql = "DELETE FROM userexam WHERE examid=$examid";
    if(!mysqli_query($link, $sql)){
      $GLOBALS['error'] = "Unable to delete users associated with exam";
      exit();
    }

    // delete the exam.
    $sql = "DELETE FROM exams WHERE id = $examid";
    if(!mysqli_query($link, $sql)){
      $GLOBALS['error'] = "Unable to delete exam";
      exit();
    }

    $GLOBALS['success'] = 'Deleted the exam with id = ' . $examid . ' succussfully';
    $exams = get_created_exams();
    $completed = get_completed_exams();
    include 'exam.html.php';
    exit();
  }

}


// display all the exam that are present in the database
$exams = get_created_exams();
$completed = get_completed_exams();
include 'exam.html.php';
