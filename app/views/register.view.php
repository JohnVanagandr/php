<div class="container">
    <!-- Formulario para registrar datos -->
    <form id="login" class="login" action="<?= URL ?>/register/validate" method="POST" autocomplete="off">
        <h1 class="login__title">Registre sus datos</h1>
        
        <!-- Campo de entrada para el nombre -->
        <div>
            <input type="text" class="login__input" name="first_name" id="first_name" placeholder="Nombre">
            <?php
            // Manejo de errores para el campo de nombre
            if (isset($data['errors']) && array_key_exists('name_error', $data['errors'])) { ?>
                <span class="login__error"><?= $data['errors']['name_error'] ?></span>
            <?php } ?>
            
            <?php
            // Manejo de errores para el caso de duplicado de usuario
            if (isset($data['errors']) && array_key_exists('user_duplicate', $data['errors'])) { ?>
                <span class="login__error"><?= $data['errors']['user_duplicate'] ?></span>
            <?php } ?>
        </div>
        
        <!-- Campo de entrada para los apellidos -->
        <div>
            <input type="text" class="login__input" name="last_name" id="last_name" placeholder="Apellidos">
            <?php
            // Manejo de errores para el campo de apellidos
            if (isset($data['errors']) && array_key_exists('last_error', $data['errors'])) { ?>
                <span class="login__error"><?= $data['errors']['last_error'] ?></span>
            <?php } ?>
        </div>
        
        <!-- Campo de entrada para el correo electrónico -->
        <div>
            <input type="text" class="login__input" id="email" name="email" placeholder="Correo electronico">
            <?php
            // Manejo de errores para el campo de correo electrónico
            if (isset($data['errors']) && array_key_exists('mail_error', $data['errors'])) { ?>
                <span class="login__error mail"><?= $data['errors']['mail_error'] ?></span>
            <?php } ?>
            
            <?php
            // Manejo de errores para el caso de duplicado de correo electrónico
            if (isset($data['errors']) && array_key_exists('mail_duplicate', $data['errors'])) { ?>
                <span class="login__error mail"><?= $data['errors']['mail_duplicate'] ?></span>
            <?php } ?>
        </div>
        
        <!-- Campo de entrada para el número de teléfono -->
        <div>
            <input type="text" class="login__input" name="phone" id="phone" placeholder="Celular">
            <?php
            // Manejo de errores para el campo de número de teléfono
            if (isset($data['errors']) && array_key_exists('phone_error', $data['errors'])) { ?>
                <span class="login__error"><?= $data['errors']['phone_error'] ?></span>
            <?php } ?>
        </div>
        
        <!-- Campo de entrada para la contraseña -->
        <div>
            <input type="password" class="login__input" name="password" id="password" placeholder="Contraseña">
            <?php
            // Manejo de errores para el campo de contraseña
            if (isset($data['errors']) && array_key_exists('pass_error', $data['errors'])) { ?>
                <span class="login__error"><?= $data['errors']['pass_error'] ?></span>
            <?php } ?>
        </div>
        
        <!-- Campo de entrada para confirmar la contraseña -->
        <div>
            <input type="password" class="login__input" name="password_confirm" id="password_confirm" placeholder="Confirme su contraseña">
            <?php
            // Manejo de errores para el campo de confirmación de contraseña
            if (isset($data['errors']) && array_key_exists('verify_error', $data['errors'])) { ?>
                <span class="login__error"><?= $data['errors']['verify_error'] ?></span>
            <?php } ?>
        </div>
        
        <!-- Panel del formulario con botón de validación y enlace de inicio de sesión -->
        <div class="login__panel">
            <button class="login__btn" id="btnRegistrar">Validar datos</button>
            <a href="<?= URL ?>/login" class="login__link">Ya tengo usuario</a>
        </div>
    </form>
</div>

<!-- Scripts externos para la validación del formulario -->
<script src="<?= URL ?>/assets/js/register.js"></script>
<script src="<?= URL ?>/assets/js/valid.js"></script>
