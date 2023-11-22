<section class="content-table">
  <div class="table-header">
    <!-- Encabezado de la tabla con título y botones -->
    <div class="tittle-table">
      <h2>Roles</h2>
      <button><a href="<?= URL ?>/roles/create">nuevo</a></button>
    </div>

    <!-- Botones para filtrar y ocultar/mostrar los filtros -->
    <div id="botones">
      <button id="principal" onclick="ocultarMostrarElemento()">Filtros</button>
      <div id="filtros" hidden>
        <!-- Opciones de filtro -->
        <label><input name="filtros" type="radio" id="cbox1" value="created_at" />Fecha creado</label>
        <label><input name="filtros" type="radio" id="cbox2" value="updated_at" />Fecha modificado</label>
        <label><input name="filtros" type="radio" id="cbox3" value="name_role" checked />Nombre</label>
      </div>
    </div>

    <!-- Barra de búsqueda -->
    <div class="input_search">
      <input id="buscar" type="search" placeholder="Buscar rol">
      <i class="bi bi-search"></i>
    </div>
  </div>

  <!-- Tabla de roles -->
  <table>
    <thead>
      <tr>
        <!-- Encabezados de las columnas -->
        <th>Nombre</th>
        <th>Fecha de creado</th>
        <th>Fecha de modificacion</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="resultados">
      <?php
      use Adso\libs\DateHelper;
      use Adso\libs\Helper;

      // Ciclo para mostrar los datos de los roles
      foreach ($data['roles'] as $value) {
      ?>
        <tr>
          <!-- Mostrar nombre del rol -->
          <td>
            <?= $value['name_role'] ?>
          </td>
          <!-- Mostrar fecha de creación del rol -->
          <td>
            <?= DateHelper::shortDate($value['created_at']) ?>
          </td>
          <!-- Mostrar fecha de modificación del rol -->
          <td>
            <?= DateHelper::shortDate($value['updated_at']) ?>
          </td>
          <!-- Botones de acciones para editar, eliminar y administrar el rol -->
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

<!-- Script para el filtrado -->
<script src="<?= URL ?>/assets/js/filtrado.js"></script>