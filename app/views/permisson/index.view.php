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
    <tbody id="contend">
      <?php
      use Adso\libs\DateHelper;
      use Adso\libs\Helper;

      foreach($data['permisos']['data'] as $value) {
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
            <button><a
                href="<?= URL ?>/permisson/editar/<?= Helper::encrypt($value['id_permission']) ?>">editar</a></button>
            <button><a
                href="<?= URL ?>/permisson/delete/<?= Helper::encrypt($value['id_permission']) ?>">eliminar</a></button>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>

  <div>
    <div class="info-pag">
      <label>
        Mostrando
        <?= $data['permisos']['totalFiltro'] ?> de
        <?= $data['permisos']['totalRegistros'] ?> registros
      </label>
    </div>
    <div id="nav-paginacion">
      <nav>
        <ul class="pagination-list">
          <?php 
          $numeroInicio = 1;
          if (($data['permisos']['paginaActual'] - 2) >= 1) {
            $numeroInicio = $data['permisos']['paginaActual'] - 2;
          }
          $numeroFin = $numeroInicio + 3;
          if ($numeroFin > $data['permisos']['totalPaginas']) {
            $numeroFin = $data['permisos']['totalPaginas'];
          }
          for($i = $numeroInicio; $i <= $numeroFin; $i++) { ?>
            <li class="pagination-item">
                <a href="<?= URL ?>/permisson/paginarPermisos/<?= $i ?>">
                  <?= $i ?>
                </a>
              </li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</section>