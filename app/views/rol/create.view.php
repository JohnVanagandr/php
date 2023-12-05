<section class="card-content">
    <form class="form-role" action="<?= URL ?>/roles/storage" method="post">
        <h1>Nuevo Rol</h1>
        <div>
            <input type="text" name="rol_name" placeholder="Nombre del rol">
            <?php
            if (isset($data["errors"])) {
                if (array_key_exists("rol_error", $data["errors"])) {
                    ?>
                    <span class="login__error">
                        <?= $data['errors']['rol_error'] ?>
                    </span>
                    <?php
                }
            }
            ?>
        </div>
        <button>Crear</button>
    </form>
</section>