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
        <?php if ($questions): ?>
          <h2>Question(<?=$_SESSION['currId']+1?>/<?=$_SESSION['ques_num']?>)</h2>
          <form class="question" method="post">
            <input type="hidden" name="questionid" value="<?=$question['id']?>">
            <p><?=  $question['title']?></p>
            <?php if ($options = get_options($question['id'])): ?>
              <?php $options = get_options($question['id']); ?>
              <?php foreach ($options as $option): ?>
                <div class="option">
                  <input type="radio" name="options" id="<?=$option['id']?>" value="<?=$option['id'] ?>">
                  <label for="<?=$option['id']?>"><?=$option['title']?></label>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>No option is given for this question</p>
            <?php endif; ?>
            <input type="hidden" name="lastId" value="<?=$_SESSION['currId']?>">
            <input type="hidden" name="link" value="finish">
            <?php if ($_SESSION['currId']+1 >= $_SESSION['ques_num']): ?>
              <button type="submit">Finish</button>
            <?php else: ?>
              <input type="hidden" name="link" value="next">
              <button type="submit">next question</button>
            <?php endif; ?>
          </form>
        <?php else: ?>
          <h3>No question added to this exam</h3>
        <?php endif; ?>
      </div>

    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
