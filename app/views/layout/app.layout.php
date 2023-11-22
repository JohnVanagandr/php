<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADSO</title>
  <link rel="stylesheet" href="<?= URL ?>/assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="<?= URL ?>/assets/js/scripts.js"></script>
</head>

<body>
  <header>
    <div class="header">
      <div class="header__logo">
        <a href="<?= URL ?>" class="header__link">
          <?= NAME ?>
        </a>
      </div>
      <div class="header__items">
        <?php
        if (isset($data['menu']) && $data['menu'] == true) { ?>
          <a href="<?= URL ?>/roles" class="header__link">Roles</a>
          <a href="<?= URL ?>/permisson" class="header__link">Permisos</a>
        <?php } else { ?>
          <a href="<?= URL ?>/login" class="header__link">Login</a>
          <a href="<?= URL ?>/register" class="header__link header__link--action">Register</a>
        <?php } ?>
      </div>
    </div>

  </header>

  <?php echo $contend; ?>

</body>

</html>