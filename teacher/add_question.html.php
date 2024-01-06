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
            <h2>Exam name: <?=$exam['title']?></h2>
            <form class="login-form" action="" method="post">
            <h2>Add new question</h2>
            <p>Please, insert the details about new question to save it.</p>
            <div class="input-field">
                <label for="">Title of the question</label>
                <input type="text" name="title" id="title" >
            </div>
            <div class="input-field">
                <label for="weight">Weight</label>
                <input type="number" name="weight">
            </div>

            <input type="hidden" name="action" value="add-question">
            <input type="hidden" name="examid" value="<?=$exam['id']?>">
            <button type="submit" class="btn btn-primary">Add question</button>
            </form>
        </div>

    </main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
