<section class="card-content">
    <form class="form-role" action="<?= URL ?>/roles/update/<?= $data['id'] ?>" method="post">
        <h1>Actualizar Rol</h1>
        <div>
            <input type="text" name="rol_name" value="<?= $data['data']['name_role'] ?>" placeholder="Nombre de rol">
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

        <div class="form-group">
            <label class="permisos-label">Permisos</label>
            <?php foreach ($data['permisos'] as $value) { ?>
                <div class="checkbox-label">
                    <input type="checkbox" name="permisos[]" value="<?= $value['id_permission'] ?>" class="permisos-checkbox">
                    <span class="permisos-description"><?= $value["description"] ?></span>
                </div>
            <?php } ?>
        </div>
        
        <button>Actualizar</button>
    </form>
</section>