<div class="container">
    <form class="login" action="<?= URL ?>/login/updatepassword/<?= $data['data'] ?>" method="POST">
        <h1 class="login__title">Modificar contraseña</h1>
        <div>
            <input type="password" name="password" class="login__input" placeholder="Contraseña">
        </div>
        <?php
            if (isset($data['errors'])) {
                if (array_key_exists('password_error', $data['errors'])) { ?>
                    <span class="login__error"><?= $data['errors']['password_error'] ?></span>
            <?php
                }
            }
            ?>
        <div>
            <input type="password" name="confirm_password" class="login__input" placeholder="Confirmar contraseña">
        </div>
        <?php
            if (isset($data['errors'])) {
                if (array_key_exists('confirm_password', $data['errors'])) { ?>
                    <span class="login__error"><?= $data['errors']['confirm_password'] ?></span>
            <?php
                }
            }
            ?>
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
                if (array_key_exists('expire_error', $data['errors'])) { ?>
                    <span class="login__error"><?= $data['errors']['expire_error'] ?></span>
            <?php
                }
            }
            ?>
        <div class="login__panel">
            <input type="hidden" name="id" value="<?php echo $data['data'] ?>">
            <button class="login__btn">Validar</button>
            <?php if (isset($data['errors'])) {
                if (array_key_exists('expire_error', $data['errors'])) { ?>
                <a href="<?= URL ?>/login/forgetpassword" class="login__link">Reenviar link</a>
            <?php
                }  
            } ?>
        </div>
    </form>
</div>