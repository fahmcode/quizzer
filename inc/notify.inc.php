<?php if(isset($GLOBALS['error'])): ?>
    <div class="note error">
      <?= $GLOBALS['error'] ?>
    </div>

  <?php endif; ?>

  <?php if(isset($GLOBALS['success'])): ?>
      <div class="note success">
        <?= $GLOBALS['success'] ?>
      </div>

  <?php endif; ?>

  <?php if(isset($GLOBALS['info'])): ?>
        <div class="note info">
          <?= $GLOBALS['info'] ?>
        </div>
  <?php endif; ?>
