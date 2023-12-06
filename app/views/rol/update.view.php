<section class="card-content">
  <form class="form-role" action="<?= URL ?>/roles/storage" method="post">
    <h1 class="titulo">Actualizar Rol</h1>

    <div class="form-group">
      <label for="rol_name" class="form-label">Nombre del rol</label>
      <input type="text" id="rol_name" name="rol_name" class="input-text" placeholder="Ingrese el nombre del rol" required>
      <?php
      if (isset($data["errors"]) && array_key_exists("rol_error", $data["errors"])) {
      ?>
        <span class="form-error">
          <?= $data['errors']['rol_error'] ?>
        </span>
      <?php
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
        
        <button class="btn-create">Actualizar</button>
    </form>
</section>