<section class="content-table">
  <div class="table-header">
    <div class="tittle-table">
      <h2>Roles</h2>
      <button><a href="<?= URL ?>/roles/create">nuevo</a></button>
    </div>
    <div id="botones">
      <button id="principal" onclick="ocultarMostrarElemento()">Filtros</button>
      <div id="miElemento" hidden>
        <label><input type="checkbox" id="cbox1" value="first_checkbox" /> filtrado por fecha creado</label>
        <label><input type="checkbox" id="cbox1" value="first_checkbox" /> filtrado por fecha modificado</label>
        <label><input type="checkbox" id="cbox1" value="first_checkbox" /> filtrado por Nombre</label>
      </div>
    </div>
    <div class="input_search">
      <input type="search" placeholder="Buscar rol">
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

      foreach ($data['roles'] as $value) {
        ?>
        <tr>
          <td>
            <?= $value['name_role'] ?>
          </td>
          <td>
            <?= DateHelper::shortDate($value['created_at']) ?>
          </td>
          <td>
            <?= DateHelper::shortDate($value['updated_at']) ?>
          </td>
          <td>
            <button><a href="<?= URL ?>/roles/editar/<?= Helper::encrypt($value['id_role']) ?>">editar</a></button>
            <button><a href="<?= URL ?>/roles/delete/<?= Helper::encrypt($value['id_role']) ?>">eliminar</a></button>
            <button><a href="<?= URL ?>/roles/manage/<?= Helper::encrypt($value['id_role']) ?>">administrar</a></button>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</section>
<script src="<?= URL ?>/assets/js/filtrado.js"></script>