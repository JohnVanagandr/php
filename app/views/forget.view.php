<div class="container">
    <form class="login" action="<?= URL ?>/login/sendEmail" method="POST">
        <h1 class="login__title">Recuperar contraseña</h1>
        <div>
            <input type="text" class="login__input" placeholder="Correo electronico" name ="email">
        </div>
        <?php  
            if (isset($data))
            ?>
            <?php
            if (isset($data['errors'])) {
                if (array_key_exists('email_empty', $data['errors'])) { ?>
                    <span class="login__error"><?= $data['errors']['email_empty'] ?></span>
            <?php
                }
            }
            ?>
            <?php
            if (isset($data['errors'])) {
                if (array_key_exists('email_error', $data['errors'])) { ?>
                    <span class="login__error"><?= $data['errors']['email_error'] ?></span>
            <?php
                }
            }
            ?>
            <?php
            if (isset($data['errors'])) {
                if (array_key_exists('email_dontexist', $data['errors'])) { ?>
                    <span class="login__error"><?= $data['errors']['email_dontexist'] ?></span>
            <?php
                }
            }
            ?>
        <div class="login__panel">
            <button class="login__btn">Enviar correo</button>
            <a href="<?= URL ?>/login" class="login__link">Regresar al login</a>
        </div>
    </form>
</div>