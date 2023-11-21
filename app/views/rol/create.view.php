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


    <?php foreach ($data['permisos'] as $value) { ?>
      <br>
      <label>
        <input type="checkbox" name="permisos[]" value="<?= $value['id_permission'] ?>">
        <?= $value["name_permisson"] ?>
      </label>
    <?php } ?>

    <button>Crear</button>
  </form>
</section>