<?php
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/header.inc.php';
?>

    <header>
      <div class="one">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/notify.inc.php'; ?>
      </div>
      <div class="two">
        <div class="logo">
          <h1>Quizzer - <?= $_SESSION['role']?></h1>
        </div>
        <!-- <div class="links">
          <a href="#" class="btn">Sign up now</a>
        </div> -->
        <div class="nav">
          <a href="." class="btn btn-secondary">Go to Home</a>
          <a href="?logout" class="btn btn-primary">Logout</a>
        </div>
      </div>
    </header>

    <main>

      <div class="user-container">
         <?php if ($result): ?>
           <h1>Exam result</h1>
           <ul>
             <li>Exam name: <?=$exam['title']?></li>
             <li>Score: <?=$result['score']?></li>
             <li>Status: </li>
           </ul>
         <?php else: ?>
           <h2>Your result is not approved yet.</h2>
         <?php endif; ?>
      </div>

    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
