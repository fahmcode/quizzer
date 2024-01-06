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
        <!-- <div class="links">
          <a href="#" class="btn">Sign up now</a>
        </div> -->
        <!-- <div class="links">
          <a href="." class="btn btn-secondary">Go to Home</a>
        </div> -->
      </div>
    </header>

    <main>


        <div class="form-container">
          <form class="login-form" action="" method="post">
            <h2>Forgot password</h2>
            <p>Enter your email to reset password and get new one</p>
            <input type="email" name="email" placeholder="email@example.com">
            <p>Create new password which is easier to remember.</p>
            <input type="text" name="new-password" placeholder="new password">
            <input type="text" name="new-password-confirm" placeholder="confirm new password">

            <input type="hidden" name="reset-password">
            <button type="submit" class="btn btn-primary">Change password</button>

            <a href="?login" class="link">Go back to login page</a>

          </form>
        </div>

    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
