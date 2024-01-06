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
        <h1>Exams to be taken</h1>
      <?php if ($exams): ?>
        <table class="styled-table">
          <thead>
            <tr>
              <th>Exam title</th>
              <th>Date created</th>
              <th>Date Scheduled</th>
              <th>Status</th>
              <th>Pass mark</th>
              <th class="action-row"></th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($exams as $exam): ?>
              <tr>
                <td><?= $exam['title'] ?></td>
                <td><?= $exam['created_date'] ?></td>
                <td><?= $exam['scheduled_date'] ?></td>
                <td><?= $exam['status'] ?></td>
                <td><?= $exam['pass_mark'] ?></td>
                <td class="action-row">
                  <form action="" method="post">
                    <input type="hidden" name="examid" value="<?=$exam['id']?>">
                    <input type="hidden" name="link" value="start">
                    <button type="submit" class="btn info">Start</button>
                  </form>
                  <form action="" method="post">
                    <input type="hidden" name="exam-id" value=" <?= $exam['id'] ?>">
                    <input type="hidden" name="link" value="view">
                    <button type="submit" class="success">View</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <h2>No exam is assigned to you.</h2>
      <?php endif; ?>

      <div class="">
        <h1>Completed</h1>
        <?php if ($completed): ?>
          <table class="styled-table">
            <thead>
              <tr>
                <th>Exam title</th>
                <th>Date created</th>
                <th>Date Scheduled</th>
                <th>Status</th>
                <th>Pass mark</th>
                <th class="action-row"></th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($completed as $exam): ?>
                <tr>
                  <td><?= $exam['title'] ?></td>
                  <td><?= $exam['created_date'] ?></td>
                  <td><?= $exam['scheduled_date'] ?></td>
                  <td><?= $exam['status'] ?></td>
                  <td><?= $exam['pass_mark'] ?></td>
                  <td class="action-row">
                    <form action="" method="post">
                      <input type="hidden" name="examid" value="<?=$exam['id']?>">
                      <input type="hidden" name="action" value="see-result">
                      <button type="submit" class="btn info">See Result</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <h2>You did not take any exam.</h2>
        <?php endif; ?>
      </div>
      </div>


    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
