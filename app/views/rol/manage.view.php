<h1>Administrar
  <?= $data["rol"]["name_role"] ?>
</h1>

<form action="<?= URL ?>/roles/assing" method="POST">
  <input type="hidden" name="rol" value="<?php echo ($data["rol"]["id_role"]) ?>">
  <?php foreach ($data['permit'] as $value) { ?>
    <br>
    <label>
      <input type="checkbox" name="permisos[]" value="<?= $value['id_permission'] ?>" <?php foreach ($data["permit_role"] as $permit_role) {
          if ($permit_role['id_permisson_fk'] == $value['id_permission']) {
            echo "checked";
            break;
          }
        } ?>>
      <?= $value['name_permisson'] ?>
    </label>
  <?php } ?>
  <div>
    <button type="submit">Enviar</button>
  </div>
</form>
