


<section class="content-table">
  <div class="table-header">
    <div class="tittle-table">
      <h2>Permisos</h2>
      <button><a href="<?= URL ?>/permisson/create">nuevo</a></button>
    </div>
    <div id="botones">
      <button id="principal" onclick="ocultarMostrarElemento()">Filtros</button>
      <div id="filtrosPer" hidden>
        <label><input name="filtros" type="radio" id="cbox11" value="created_at" />Fecha creado</label>
        <label><input name="filtros" type="radio" id="cbox22" value="updated_at" />Fecha modificado</label>
        <label><input name="filtros" type="radio" id="cbox33" value="name_permisson" checked />Nombre</label>
      </div>
    </div>
    <div class="input_search">
      <input id="buscar" type="search" placeholder="Buscar rol">
      <i class="bi bi-search"></i>
    </div>
  </div>
  <table>
    <thead>
      <tr>
        <th>Nombre</th>
                <th>Descripción</th>
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
                        <?= $value['description'] ?>
                    </td>
          <td>
            <?= DateHelper::shortDate($value['created_at']) ?>
          </td>
          <td>
            <?= DateHelper::shortDate($value['updated_at']) ?>
          </td>
                
          <td>
              <?php

              if(in_array('permisson.editar' , $data['permisos2'])){
                
              ?>
              <button><a
                href="<?= URL ?>/permisson/editar/<?= Helper::encrypt($value['id_permission']) ?>">editar</a></button>
                  <?php
            }
            if(in_array('permisson.delete', $data['permisos2'])) {
            ?>
            <button><a
                href="<?= URL ?>/permisson/delete/<?= Helper::encrypt($value['id_permission']) ?>">eliminar</a></button>
            <?php
            }
            
            ?>
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
<script src="<?= URL ?>/assets/js/filtrado.js"></script>