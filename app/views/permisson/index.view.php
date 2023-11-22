<section class="content-table">
  <div class="table-header">
    <div class="tittle-table">
      <h2>Permisos</h2>
      <button><a href="<?= URL ?>/permisson/create">nuevo</a></button>
    </div>
    <div class="input_search">
      <input type="search" placeholder="Buscar permiso">
      <i class="bi bi-search"></i>
    </div>
  </div>
  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Fecha de creado</th>
        <th>Fecha de modificacion</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php

      use Adso\libs\DateHelper;
      use Adso\libs\Helper;

      foreach ($data['permisos'] as $value) {
      ?>
        <tr>
          <td>
            <?= $value['name_permisson'] ?>
          </td>
          <td>
            <?= DateHelper::shortDate($value['created_at']) ?>
          </td>
          <td>
            <?= DateHelper::shortDate($value['updated_at']) ?>
          </td>
          <td>
            <button><a href="<?= URL ?>/permisson/editar/<?= Helper::encrypt($value['id_permission']) ?>">editar</a></button>
            <button><a href="<?= URL ?>/permisson/delete/<?= Helper::encrypt($value['id_permission']) ?>">eliminar</a></button>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
  <div>
    <ul>
      <?php
      $numeroPaginas = ceil(count(($data['permisos'])) / 12);
      echo  count(($data['permisos']));
      echo  $numeroPaginas;
      for ($i = 0; $i < count(($data['permisos'])); $i++) {
        echo "hola";
      }
      ?>
    </ul>
  </div>


</section>