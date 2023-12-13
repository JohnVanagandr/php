<div class="container">
    <!-- Formulario para modificar la contraseña -->
    <form class="login" action="<?= URL ?>/login/updatepassword/<?= $data['data'] ?>" method="POST">
        <!-- Título del formulario -->
        <h1 class="login__title">Modificar contraseña</h1>
        
        <!-- Campo de entrada para la nueva contraseña -->
        <div>
            <input type="password" name="password" class="login__input" placeholder="Contraseña">
        </div>

        <!-- Manejo de errores para el campo de contraseña -->
        <?php
        if (isset($data['errors']) && array_key_exists('password_error', $data['errors'])) { ?>
            <span class="login__error"><?= $data['errors']['password_error'] ?></span>
        <?php } ?>

        <!-- Campo de entrada para confirmar la nueva contraseña -->
        <div>
            <input type="password" name="confirm_password" class="login__input" placeholder="Confirmar contraseña">
        </div>

        <!-- Manejo de errores para el campo de confirmación de contraseña -->
        <?php
        if (isset($data['errors']) && array_key_exists('confirm_password', $data['errors'])) { ?>
            <span class="login__error"><?= $data['errors']['confirm_password'] ?></span>
        <?php } ?>

        <!-- Repetición del manejo de errores para el campo de contraseña (¿error tipográfico?) -->
        <?php
        if (isset($data['errors']) && array_key_exists('password_error', $data['errors'])) { ?>
            <span class="login__error"><?= $data['errors']['password_error'] ?></span>
        <?php } ?>

        <!-- Manejo de errores para el caso de caducidad de enlace (¿restablecimiento de contraseña?) -->
        <?php
        if (isset($data['errors']) && array_key_exists('expire_error', $data['errors'])) { ?>
            <span class="login__error"><?= $data['errors']['expire_error'] ?></span>
        <?php } ?>

        <!-- Panel del formulario con un campo oculto para el id y botón de validación -->
        <div class="login__panel">
            <input type="hidden" name="id" value="<?php echo $data['data'] ?>">
            <button class="login__btn">Validar</button>
            
            <!-- Enlace para reenviar el enlace en caso de error de caducidad -->
            <?php
            if (isset($data['errors']) && array_key_exists('expire_error', $data['errors'])) { ?>
                <a href="<?= URL ?>/login/forgetpassword" class="login__link">Reenviar link</a>
            <?php } ?>
        </div>
    </form>
</div>

