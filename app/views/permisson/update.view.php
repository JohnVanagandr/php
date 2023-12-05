<section class="card-content">
    <form class="form-role" action="<?= URL ?>/permisson/update/<?= $data["id"] ?>" method="post">
        <h1>Actualizar Permiso</h1>
        <div>
            <input type="text" name="per_name" placeholder="Nombre de permiso"
                value="<?= $data["data"]["name_permisson"] ?>">
            <?php
            if (isset($data["errors"])) {
                if (array_key_exists("per_error", $data["errors"])) {
                    ?>
                    <span class="login__error">
                        <?= $data['errors']['per_error'] ?>
                    </span>
                    <?php
                }
            }
            ?>
        </div>
        <button>Actualizar</button>
    </form>
</section>