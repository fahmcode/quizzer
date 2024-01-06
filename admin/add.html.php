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
          <h1>Quizzer</h1>
        </div>
        <div class="nav">
          <a href="." class="btn btn-secondary">Go to Home</a>
          <a href="?logout" class="btn btn-primary">Logout</a>
        </div>
        <!-- <div class="links">
          <a href="#" class="btn">Sign up now</a>
        </div> -->

      </div>
    </header>

    <main>

      <div class="form-container">
        <form class="login-form" action="" method="post">
          <h2>Add a new user</h2>
          <p>Please, insert the details about the new user to save it.</p>
          <input type="text" name="name" placeholder="user name" value="">
          <input type="email" name="email" placeholder="email@example.com" value="">
          <input type="password" name="password" placeholder="password..." value="">

          <div class="role">
            <label for="role">Account type:</label>

            <select name="role" id="role">
              <option value="student">Student</option>
              <option value="teacher">Teacher</option>
              <option value="committee">Committee</option>
            </select>
          </div>

          <input type="hidden" name="add-user">
          <button type="submit" class="btn btn-primary">Save now</button>
        </form>
      </div>

    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
