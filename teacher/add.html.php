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
          <h2>Add new Exam</h2>
          <p>Please, insert the details about new exam to save it.</p>
          <div class="input-field">
          <label for="">Title of the exam</label>
            <input type="text" name="title" id="title" value="">
          </div>
          <div class="date">

            <div class="input-field">
              <label for="created_date">Created date</label>
              <input type="date" name="created_date" value="">
            </div>
            <div class="input-field">
              <label for="scheduled_date">Scheduled date</label>
              <input type="date" name="scheduled_date" value="">
            </div>
          </div>
          <div class="input-field">
            <label for="pass_mark">Pass mark</label>
            <input type="number" name="pass_mark" value="">
          </div>

          <div class="status">
            <label for="status">Status:</label>

            <select name="status" id="status">
              <option value="created">Created</option>
              <option value="pending">Pending</option>
              <option value="completed">Completed</option>
            </select>
          </div>

          <input type="hidden" name="action" value="add-exam">
          <button type="submit" class="btn btn-primary">Save now</button>
        </form>
      </div>

    </main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
