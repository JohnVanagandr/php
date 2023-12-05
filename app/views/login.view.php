<div class="container">
    <form class="login" action="<?= URL ?>/login/validate" method="POST" id="form">
        <h1 class="login__title">Ingresar all sistema</h1>
        <div>
            <input type="text" name="user" id ="user" class="login__input" placeholder="Usuario" value="<?= isset($data['data']['user']) ? $data['data']['user'] : ''  ?>">
            <?php
            if (isset($data['errors'])) {
                if (array_key_exists('user_error', $data['errors'])) { ?>
                    <span class="login__error"><?= $data['errors']['user_error'] ?></span>
            <?php
                }
            }
            ?>
        </div>
        <div>
            <input type="password" name="password" id="password" class="login__input" placeholder="Contraseña" value="<?= isset($data['data']['password']) ? $data['data']['password'] : ''  ?>">
            <?php
            if (isset($data['errors'])) {
                if (array_key_exists('password_error', $data['errors'])) { ?>
                    <span class="login__error"><?= $data['errors']['password_error'] ?></span>
            <?php
                }
            }
            ?>
            <?php
            if (isset($data['errors'])) {
                if (array_key_exists('password_incorrect', $data['errors'])) { ?>
                    <span class="login__error"><?= $data['errors']['password_incorrect'] ?></span>
            <?php
                }
            }
            ?>
        </div>
        <div class="remember">
            <input type="checkbox" value="on" id="remember" name="remember" class="remember_checkbox" <?= isset($data['data']['remember']) ? 'checked' : '' ?>>
            <label for="remember" class="remember_label">¡Recordar datos!</label>
        </div>
        <div class="login__panel">
            <button class="login__btn" id="btnValidarLogin">Ingresar</button>
            <a href="<?= URL ?>/login/forgetpassword" class="login__link">¿Olvido su contraseña?</a>
        </div>
        <span class="login__separator"></span>
        <a href="<?= URL ?>/register" class="login__link login__link--center">Registrarme al sistema</a>
    </form>
</div>

<script src="<?= URL ?>/assets/js/scripts.js"></script>
