<div>
    <form action="<?= URL ?>/profile/update" method="post" enctype="multipart/form-data">
        <h1>selecciona una imagen</h1>
        <input type="file" name="fichero" placeholder="crea un nuevo rol">
        <?php
            if (isset($data['errores'])) {
                if (array_key_exists('error_file', $data['errores'])) { ?>
                    <span class="login__error"><?= $data['errores']['error_file'] ?></span>
            <?php
                }
                if (array_key_exists('error_size', $data['errores'])) { ?>
                    <span class="login__error"><?= $data['errores']['error_size'] ?></span>
            <?php
                }if (array_key_exists('error_type', $data['errores'])) { ?>
                    <span class="login__error"><?= $data['errores']['error_type'] ?></span>
            <?php
                }if (array_key_exists('error_load', $data['errores'])) { ?>
                    <span class="login__error"><?= $data['errores']['error_load'] ?></span>
            <?php
                }
            }
            ?>
        <button>subir imagen</button>
    </form>
</div>

