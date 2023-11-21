<section class="card-content">
    <form class="form-role" action="<?= URL ?>/permisson/storage" method="post">
        <h1>Nuevo Permiso</h1>
        
        <div>
            <input type="text" name="per_name" placeholder="Nombre del permiso">
            <input type="text" name="slug" placeholder="Ingrese el slug">
            <input type="text" name="descripcion" placeholder="Descripcion del permiso">
            
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
        <button>Crear</button>
    </form>
</section>