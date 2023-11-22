<section class="card-content">
  <!-- Inicio del formulario para crear un nuevo rol -->
  <form class="form-role" action="<?= URL ?>/roles/storage" method="post">
    <h1>Nuevo Rol</h1>

    <div>
      <!-- Input para ingresar el nombre del rol -->
      <input type="text" name="rol_name" placeholder="Nombre del rol">
      
      <!-- Verificación de errores para el nombre del rol -->
      <?php
      // Verifica si existen errores en los datos
      if (isset($data["errors"])) {
        // Verifica si hay un error específico para el rol
        if (array_key_exists("rol_error", $data["errors"])) {
      ?>
          <!-- Muestra el mensaje de error -->
          <span class="login__error">
            <?= $data['errors']['rol_error'] ?>
          </span>
      <?php
        }
      }
      ?>
    </div>
    <!-- Iteración sobre los permisos disponibles -->
    <?php foreach ($data['permisos'] as $value) { ?>
      <br>
      <label>
        <!-- Checkbox para seleccionar los permisos -->
        <input type="checkbox" name="permisos[]" value="<?= $value['id_permission'] ?>">
        <!-- Nombre del permiso -->
        <?= $value["name_permisson"] ?>
      </label>
    <?php } ?>

    <!-- Botón para enviar el formulario -->
    <button>Crear</button>
  </form>
  <!-- Fin del formulario -->
</section>
