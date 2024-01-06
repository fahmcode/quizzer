<?php
include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/header.inc.php';
?>

    <header>
      <div class="one">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/notify.inc.php'; ?>
      </div>
      <div class="two">
        <div class="logo">
          <h1>Quizzer - <?= $_SESSION['role'] ?></h1>
        </div>
        <div class="links">
          <form action="" method="post">
            <input type="hidden" name="action" value="add">
            <button type="submit" class="btn-primary">Add User</button>
          </form>
          <div class="nav">
            <a href="." class="btn btn-secondary">Go to Home</a>
            <a href="?logout" class="btn btn-primary">Logout</a>
          </div>
        </div>

      </div>

    </header>

    <main>

      <div class="user-container">
        <?php if ($users): ?>
          <table class="styled-table">
            <thead>
              <tr>
                <th>Name of student</th>
                <th>Email address</th>
                <th>Privilage</th>
                <th class="action-row"></th>
              </tr>
            </thead>
            <tbody>


                <?php foreach ($users as $user): ?>
                  <tr>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td class="action-row">
                      <form action="" method="post">
                        <input type="hidden" name="user-id" value="<?= $user['id'] ?>">
                        <input type="hidden" name="action" value="edit">
                        <button type="submit" class="info">edit</button>
                      </form>
                      <form action="" method="post">
                        <input type="hidden" name="user-id" value=" <?= $user['id'] ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="error">delete</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>


            </tbody>
          </table>
        <?php else: ?>
          <h3>No user is found</h3>
        <?php endif; ?>
      </div>

    </main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/quizzer/inc/footer.inc.php'; ?>
