
<section class="card-content">
    <form class="form-role" action="<?= URL ?>/roles/update/<?= $data['id'] ?>" method="post">
        <h1>Actualizar Rol</h1>
        <div>
            <input class="input-text form-label" type="text" name="rol_name" value="<?= $data['data']['name_role'] ?>"
                placeholder="Nombre de rol">
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
        <button class="btn-create" >Actualizar</button>
    </form>
