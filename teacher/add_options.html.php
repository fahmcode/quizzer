<?php
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/header.inc.php';
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/notify.inc.php';
 ?>

    <header>
      <div class="one">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/notify.inc.php'; ?>
      </div>
      <div class="two">
        <div class="logo">
          <h1>Quizzer - <?= $_SESSION['role']?></h1>
        </div>
        <div class="links">
          <a href="." class="btn btn-secondary">Go to Home</a>
          <a href="?logout" class="btn btn-primary">Logout</a>
        </div>
      </div>
    </header>

    <main>

    <div class="form-container">
        <form class="login-form" action="" method="post">
          <h2>Exam : <?=$exam['title']?></h2>
          <h2>Question: <?=$question['title']?></h2>
          <p>Please, insert new options for question to save it.</p>
          <div class="input-field">
          <label for="">Option 1</label>
            <input type="text" name="option1" id="option1" value="">
          </div>
          <div class="input-field">
          <label for="">Option 1</label>
            <input type="text" name="option2" id="option2" value="">
          </div>
          <div class="input-field">
          <label for="">Option 1</label>
            <input type="text" name="option3" id="option3" value="">
          </div>
          <div class="input-field">
          <label for="">Option 1</label>
            <input type="text" name="option4" id="option4" value="">
          </div>
          <div class="input-field">
            <label for="correct">Correct option</label>
            <input type="number" name="correct" value="">
          </div>

          <input type="hidden" name="action" value="add-options">
          <input type="hidden" name="examid" value="<?=$exam['id']?>">
          <input type="hidden" name="questionid" value="<?=$question['id']?>">
          <button type="submit" class="btn btn-primary">Save options</button>
        </form>
      </div>

    </main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
