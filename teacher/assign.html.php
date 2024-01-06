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
      <div class="user-container">
      <h2>Assign exam to users</h2>
      <h3>Exam name: <?=$exam['title']?></h3>
      <p>Select all users that you want to add to exams</p>
      <form action="" method="post">
        <?php foreach ($users as $user): ?>
          <div>
            <input type="checkbox" name="users[]" value="<?=$user['id']?>" id="<?=$user['id']?>" />
            <label for="<?=$user['id']?>"><?=$user['name']?></label>
          </div>
        <?php endforeach; ?>
        <input type="hidden" name="examid" value="<?=$exam['id']?>">
        <input type="hidden" name="action" value="assign">
        <button type="submit" class="btn btn-primary">Assign now</button>
        </form>
      </div>

    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
