<?php
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/header.inc.php';
?>

    <header>
      <div class="one">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/notify.inc.php'; ?>
      </div>
      <div class="two">
        <div class="logo">
          <h1>Quizzer</h1>
        </div>
      </div>
    </header>

    <main>


        <div class="form-container">
          <form class="login-form" action="" method="post">
            <h2>Login to continue</h2>
            <p>Please, enter your information to log in into the system</p>
            <input type="text" name="email" placeholder="email@example.com">
            <input type="password" name="password" placeholder="password...">
            <a href="?forgot" class="link">Forgot your password?</a>
            <input type="hidden" name="login-user">
            <button type="submit" class="btn btn-primary">Log in</button>
          </form>
        </div>

    </main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
