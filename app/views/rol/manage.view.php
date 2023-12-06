<section class="card-content">
  
  
  <form class="form-role" action="<?= URL ?>/roles/assing" method="POST">
    <h1 class="titulo" >Administrar permisos de:

      <strong>

        <?= $data["rol"]["name_role"] ?>
      </strong>
    </h1>
    
    <input type="hidden" name="rol" value="<?php echo ($data["rol"]["id_role"]) ?>">
    
    <?php foreach ($data['permit'] as $value) { ?>
      <div class="form-group"> 
        <label>
          <input  type="checkbox" name="permisos[]" value="<?= $value['id_permission'] ?>" <?php foreach ($data["permit_role"] as $permit_role) {
              if ($permit_role['id_permisson_fk'] == $value['id_permission']) {
                echo "checked";
                break;
              }
            } ?>>
  
          <span class="permisos-description"><?= $value["description"] ?></span>
  
        </label>
      </div>
    <?php } ?>

    
      <button class="btn-create">Enviar</button>
  
  </form>

</section>