<div class="container">
  <form id="login" class="login" action="<?= URL ?>/register/validate" method="POST" autocomplete="off">
    <h1 class="login__title">Registre sus datos</h1>
    <div>
      <input type="text" class="login__input" name="first_name" id="first_name" placeholder="Nombre" value="<?= isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '' ?>">
      <?php
      if (isset($data['errors'])) {
        if (array_key_exists('name_error', $data['errors'])) { ?>
          <span class="login__error">
            <?= $data['errors']['name_error'] ?>
          </span>
          <?php
        }
      }
      ?>
    </div>
    <div>
      <input type="text" class="login__input" name="last_name" id="last_name" placeholder="Apellidos" value="<?= isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : '' ?>">
      <?php
      if (isset($data['errors'])) {
        if (array_key_exists('last_error', $data['errors'])) { ?>
          <span class="login__error">
            <?= $data['errors']['last_error'] ?>
          </span>
          <?php
        }
      }
      ?>
    </div>
    <div>
      <input type="text" class="login__input" id="email" name="email" placeholder="Correo electronico" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
      <?php
      if (isset($data['errors'])) {
        if (array_key_exists('mail_error', $data['errors'])) { ?>
          <span class="login__error mail">
            <?= $data['errors']['mail_error'] ?>
          </span>
          <?php
        }
      }
      ?>
      <?php
      if (isset($data['errors'])) {
        if (array_key_exists('mail_duplicate', $data['errors'])) { ?>
          <span class="login__error mail">
            <?= $data['errors']['mail_duplicate'] ?>
          </span>
          <?php
        }
      }
      ?>
    </div>
    <div>
      <input type="text" class="login__input" id="user_name" name="user_name" placeholder="Nombre de usuario" value="<?= isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : '' ?>">
      <?php
      if (isset($data['errors'])) {
        if (array_key_exists('username_error', $data['errors'])) { ?>
          <span class="login__error mail">
            <?= $data['errors']['username_error'] ?>
          </span>
          <?php
        }
      }
      if (isset($data['errors'])) {
        if (array_key_exists('user_duplicate', $data['errors'])) { ?>
          <span class="login__error mail">
            <?= $data['errors']['user_duplicate'] ?>
          </span>
          <?php
        }
      }
      ?>
      <?php
      ?>
    </div>
    <div>
      <input type="text" class="login__input" name="phone" id="phone" placeholder="Celular" value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>">
      <?php
      if (isset($data['errors'])) {
        if (array_key_exists('phone_error', $data['errors'])) { ?>
          <span class="login__error">
            <?= $data['errors']['phone_error'] ?>
          </span>
          <?php
        }
      }
      if (isset($data['errors'])) {
        if (array_key_exists('phone_error_string', $data['errors'])) { ?>
          <span class="login__error">
            <?= $data['errors']['phone_error_string'] ?>
          </span>
          <?php
        }
      }
      if (isset($data['errors'])) {
        if (array_key_exists('phone_error_length', $data['errors'])) { ?>
          <span class="login__error">
            <?= $data['errors']['phone_error_length'] ?>
          </span>
          <?php
        }
      }
      ?>
    </div>
    <div>
      <input type="password" class="login__input" name="password" id="password" placeholder="Contraseña" value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>">
      <?php
      if (isset($data['errors'])) {
        if (array_key_exists('pass_error', $data['errors'])) { ?>
          <span class="login__error">
            <?= $data['errors']['pass_error'] ?>
          </span>
          <?php
        }
      }
      ?>
    </div>
    <div>
      <input type="password" class="login__input" name="password_confirm" id="password_confirm"
        placeholder="Confirme su contraseña" value="<?= isset($_POST['password_confirm']) ? htmlspecialchars($_POST['password_confirm']) : '' ?>">
      <?php
      if (isset($data['errors'])) {
        if (array_key_exists('verify_error', $data['errors'])) { ?>
          <span class="login__error">
            <?= $data['errors']['verify_error'] ?>
          </span>
          <?php
        }
      }
      ?>
    </div>
    <div class="login__panel">
      <button class="login__btn" id="btnRegistrar">Validar datos</button>
      <a href="<?= URL ?>/login" class="login__link">Ya tengo usuario</a>
    </div>
  </form>
</div>

<script src="<?= URL ?>/assets/js/register.js"></script>
<!-- <script src="<?= URL ?>/assets/js/valid.js"></script> -->