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
         <h1>Online Exam Name</h1>
         <ul>
           <li>Number of Questions: 50</li>
           <li>Duration: 2 hours</li>
           <li>Date: June 30, 2023</li>
           <li>Time: 10:00 AM - 12:00 PM</li>
         </ul>
         <h2>Instructions</h2>
         <ol>
           <li>Make sure you have a stable internet connection.</li>
           <li>Use a desktop or laptop computer to take the exam.</li>
           <li>Do not use any electronic devices other than the computer during the exam.</li>
           <li>Do not communicate with anyone during the exam.</li>
           <li>Submit the exam before the time runs out.</li>
         </ol>
       <form action="" method="post" style="margin-top: 1rem;">
         <input type="hidden" name="link" value="questions">
         <input type="hidden" name="exam-id" value="<?= $exam['id'] ?>">
         <button type="submit" class="btn btn-primary">Start the exam</button>
       </form>
      </div>

    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
