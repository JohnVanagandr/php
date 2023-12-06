<section class="card-content">
  <form class="form-role" action="<?= URL ?>/permisson/update/<?= $data["id"] ?>" method="post">
    <h1 class="titulo">Actualizar Permiso</h1>
    <div class="form-group">
      <label for="per_name" class="form-label">Selecciona una acción</label>
      <select name="per_name" id="per_name" class="input-text">
        <option value="Visualizar">Visualizar</option>
        <option value="Crear">Crear</option>
        <option value="Actualizar">Actualizar</option>
        <option value="Eliminar">Eliminar</option>
      </select>

      <label for="slug" class="form-label">Selecciona un controlador</label>
      <select name="slug" id="slug" class="input-text">
        <option value="permisson">Permisos</option>
        <option value="roles">Roles</option>
      </select>

      <?php
      if (isset($data["errors"])) {
        if (array_key_exists("per_error", $data["errors"])) {
      ?>
          <span class="form-error">
            <?= $data['errors']['per_error'] ?>
          </span>
      <?php
        }
      } 
      ?>
    </div>
    <button class="btn-create">Actualizar</button>
  </form>
</section>