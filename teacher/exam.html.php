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
          <form action="" method="post">
            <input type="hidden" name="link" value="add-exam">
            <button type="submit" class="btn-primary">Add Exam</button>
          </form>
          <a href="?logout" class="btn btn-primary">Logout</a>
        </div>
      </div>
    </header>

    <main>
      <h1>Created exams</h1>
      <?php if($exams) : ?>
        <div class="user-container">
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
                    <input type="hidden" name="examid" value="<?= $exam['id'] ?>">
                    <input type="hidden" name="action" value="send-exam">
                    <button type="submit" class="info">Send to Committee</button>
                  </form>
                  <form action="" method="post">
                    <input type="hidden" name="examid" value="<?= $exam['id'] ?>">
                    <input type="hidden" name="link" value="assign-exam">
                    <button type="submit" class="info">Assign</button>
                  </form>
                  <form action="" method="post">
                    <input type="hidden" name="examid" value="<?= $exam['id'] ?>">
                    <input type="hidden" name="action" value="delete-exam">
                    <button type="submit" class="error">delete</button>
                  </form>
                  <form action="" method="post">
                    <input type="hidden" name="examid" value=" <?= $exam['id'] ?>">
                    <input type="hidden" name="link" value="view-exam">
                    <button type="submit" class="success">View</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
      <?php else : ?>
        <h2>No exam is available, When exam added it will appear here.</h2>
      <?php endif ;?>


      <h1>Completed exams</h1>
      <?php if($completed) : ?>
        <div class="user-container">
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
                    <input type="hidden" name="examid" value="<?= $exam['id'] ?>">
                    <input type="hidden" name="action" value="submit-result">
                    <button type="submit" class="info">Submit Result</button>
                  </form>
                  <form action="" method="post">
                    <input type="hidden" name="examid" value=" <?= $exam['id'] ?>">
                    <input type="hidden" name="action" value="reassign-exam">
                    <button type="submit" class="success">ReAssign exam</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
      <?php else : ?>
        <h2>No exam is completed.</h2>
      <?php endif ;?>
    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
