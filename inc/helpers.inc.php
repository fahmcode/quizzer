<?php
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/db.inc.php';


function logout(){
  // unset the session
  $_SESSION['id'] = '';
  $_SESSION['name'] = '';
  $_SESSION['email'] = '';
  $_SESSION['role'] = '';
  $_SESSION['loggedIn'] = FALSE;

  // unset and destroy session
  session_unset();
  session_destroy();
}

// get all users with student role
function get_all_users(){
  $response = false;
  global $link;

  $sql = "SELECT * FROM `users` WHERE NOT role='admin'";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $users[] = $row;
      }
      $response = $users;
    }
  }
  return $response;
}

// get all users with student role
function get_users(){
  $response = false;
  global $link;

  $sql = "SELECT * FROM users WHERE role='student'";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $users[] = $row;
      }
      $response = $users;
    }
  }
  return $response;
}

// get result of an exam for a user
function get_user_result($userid, $examid){
  $response = false;
  global $link;

  $sql = "SELECT * FROM results WHERE userid=$userid AND examid=$examid AND status=1";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      $response = mysqli_fetch_assoc($result);
    }
  }
  return $response;
}

// get exam for a user
function get_exam_by_user($userid){
  $response = false;
  global $link;

  $sql = "SELECT exams.id, `title`, `created_date`, `scheduled_date`, `pass_mark`, `status` FROM `users`
                  INNER JOIN `userexam` ON users.id = userid
                  INNER JOIN exams ON examid = exams.id
                  WHERE users.id = $userid  AND status='approved'";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $exams[] = $row;
    }
    $response = $exams;
  }
  return $response;
}

// get completed exam for a user
function get_completed_exams_by_user($userid){
  $response = false;
  global $link;

  $sql = "SELECT exams.id, `title`, `created_date`, `scheduled_date`, `pass_mark`, `status` FROM `users`
                  INNER JOIN `userexam` ON users.id = userid
                  INNER JOIN exams ON examid = exams.id
                  WHERE users.id = $userid  AND status='completed'";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $exams[] = $row;
    }
    $response = $exams;
  }
  return $response;
}

// get all completed exams
function get_completed_exams(){
  $response = false;
  global $link;

  $sql = "SELECT * FROM exams WHERE status='completed'";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $exams[] = $row;
    }
    $response = $exams;
  }
  return $response;
}

// get all options for a question
function get_options($questionid){
  $response = false;
  global $link;

  $result = mysqli_query($link, "SELECT * FROM options WHERE questionid = '$questionid'");
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $options[] = $row;
    }
    $response = $options;
  }
  return $response;
}

// get an option detail
function get_option($optionid){
  $response = false;
  global $link;
  $sql = "SELECT * FROM options WHERE id = $optionid";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) == 1){
    $response = mysqli_fetch_assoc($result);
  }
  return $response;
}

// get number of question in an exam
function get_ques_num($examid){
  $ques_num = 0;
  global $link;
  $result = mysqli_query($link, "SELECT * FROM questions WHERE examid = $examid");
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $ques_num++;
    }
  }
  return $ques_num;
}

// get all questions in an exam
function get_questions($examid){
  $response = false;
  global $link;
  $result = mysqli_query($link, "SELECT * FROM questions WHERE examid = $examid");
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $questions[] = $row;
    }
    $response = $questions;
  }
  return $response;
}

// get all exams
function get_exams(){
  $response = false;
  global $link;

  $result = mysqli_query($link, "SELECT * FROM exams");
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $exams[] = $row;
    }
    $response = $exams;
  }
  return $response;
}

// get exam detail
function get_exam_detail($examid){
  $response = false;
  global $link;
  $result = mysqli_query($link, "SELECT * FROM exams WHERE id = '$examid'");
  if(mysqli_num_rows($result) == 1){
    $response = mysqli_fetch_assoc($result);
  }
  return $response;
}

// get a question detail
function get_question_detail($questionid){
  $response = false;
  global $link;
  $result = mysqli_query($link, "SELECT * FROM questions WHERE id = $questionid ");
  if(mysqli_num_rows($result) == 1){
    $response = mysqli_fetch_assoc($result);
  }
  return $response;
}

// get question detail for an exam
function get_question_detail_by_exam($examid){
  global $link;
  $result = mysqli_query($link, "SELECT * FROM questions WHERE examid = $examid ");
  $question = mysqli_fetch_assoc($result);
  return $question;
}

// get a result for an exam
function get_result($examid){
  $response = false;
  global $link;
  $result = mysqli_query($link, "SELECT * FROM results WHERE examid=$examid");
  if(mysqli_num_rows($result) == 1){
    $response = mysqli_fetch_assoc($result);
  }
  return $response;
}

// get an option detail
function get_option_by_id($optionid){
  $response = false;
  global $link;
  $sql = "SELECT * FROM options WHERE id = $optionid";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) == 1){
    $response = mysqli_fetch_assoc($result);
  }
  return $response;
}

// get all exams in pending state
function get_pending_exams(){
  $response = false;
  global $link;

  $result = mysqli_query($link, "SELECT * FROM exams WHERE status='pending'");
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $exams[] = $row;
    }
    $response = $exams;
  }
  return $response;
}

// get all exams in created state
function get_created_exams(){
  $response = false;
  global $link;

  $result = mysqli_query($link, "SELECT * FROM exams WHERE status='created'");
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $exams[] = $row;
    }
    $response = $exams;
  }
  return $response;
}

// get all exams in approved state
function get_approved_exams(){
  $response = false;
  global $link;

  $result = mysqli_query($link, "SELECT * FROM exams WHERE status='approved'");
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $exams[] = $row;
    }
    $response = $exams;
  }
  return $response;
}
