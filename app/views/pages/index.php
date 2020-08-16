<?php require(APP_ROOT . '/views/inc/header.php'); ?>
<h1><?php echo $data['number']; ?></h1>

<table>
  <?php for ($i = 1; $i <= $data['number']; $i++) : ?>
    <tr>
      <?php for ($j = 1; $j <= $data['number']; $j++) : ?>
        <?php $result = $i * $j; ?>
        <?php $className = ($j % 2 == 0) ? 'even' : 'odd'; ?>
        <td class="<?php echo $className; ?>" id="<?php echo $result; ?>" onclick="single_action(<?php echo $result; ?>); return false;" ondblclick="double_action(<?php echo $result; ?>); return false;">
          <?php
          echo $result;
          ?>
        </td>
      <?php endfor; ?>
    </tr>
  <?php endfor; ?>
</table>

<?php require(APP_ROOT . '/views/inc/footer.php'); ?>