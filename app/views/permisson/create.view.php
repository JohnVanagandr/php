<section class="card-content">
    <form class="form-role" action="<?= URL ?>/permisson/storage" method="post">
        <h1>Nuevo Permiso</h1>
        
        <div>
            <label for="per_name"> Selecciona una acción</label>

            <select name="per_name" id="per_name">   
              <option value="Visualizar">Visualizar</option>
              <option value="Crear">Crear</option>
              <option value="Actualizar">Actualizar</option>
              <option value="Eliminar">Eliminar</option>
            </select>

          <label for="per_name"> Selecciona un controlador</label>

          <select name="slug" id="slug">
            
            <option value="permisson">Permisos</option>
            <option value="roles">Roles</option>

          </select>

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