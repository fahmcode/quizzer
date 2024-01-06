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
        <div class="links">
        <?php if ($exam['status'] != 'completed'): ?>
        <form action="" method="post">
          <input type="hidden" name="examid" value="<?=$exam['id']?>">
          <input type="hidden" name="link" value="add-question">
          <button class="btn btn-primary" type="submit">Add question</button>
        </form>
      <?php endif; ?>
          <a href="." class="btn btn-secondary">Go to Home</a>
          <a href="?logout" class="btn btn-primary">Logout</a>
        </div>
      </div>
    </header>

    <main>

    <div class="user-container">
        <h1>Exam details</h1>
        <ul>
          <li>Name: <?= $exam['title'] ?></li>
          <li>Passmark: <?= $exam['pass_mark'] ?></li>
          <li>Status: <?=$exam['status']?></li>
          <li>Questions: <?=get_ques_num($exam['id'])?></li>
        </ul>
        <h2>Questions:</h2>
        <?php if ($questions): ?>
          <ol>
            <?php foreach ($questions as $question): ?>
              <li><?=$question['title']?>
                <?php if (!get_options($question['id'])): ?>
                  <form action="" method="post">
                    <input type="hidden" name="questionid" value="<?=$question['id']?>">
                    <input type="hidden" name="examid" value="<?=$exam['id']?>">
                    <input type="hidden" name="link" value="add-options">
                    <button type="submit">Add Options</button>
                  </form>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ol>
        <?php else: ?>
          <h3>No questions added yet</h3>
        <?php endif; ?>
      </div>

    </main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
