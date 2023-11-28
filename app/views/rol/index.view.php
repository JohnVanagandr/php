<section class="content-table">
    <div class="table-header">
        <div class="tittle-table">
            <h2>Roles</h2>
            <button><a href="<?= URL ?>/roles/create">nuevo</a></button>
            <button class="btn-table" id="filter" onclick="ocultarMostrarElemento()"><a href="">Filtrado</a></button>
        </div>
        <form id="search" class="search" action="<?= URL ?>/roles/search" method="POST" autocomplete="off">
        <div class="input_search">
            <input type="search" name="search_rol" value="<?= isset($_POST['search_rol']) ? htmlspecialchars($_POST['search_rol']) : '' ?>" placeholder="Buscar rol">
            <button type="submit" class="bi bi-search"></button>
        </div>
        </form>
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

        foreach ($data['roles'] as $rol) {
            ?>
            <tr>
                <td>
                    <?= $rol['name_role'] ?>
                </td>
                <td>
                    <?= DateHelper::shortDate($rol['created_at']) ?>
                </td>
                <td>
                    <?= DateHelper::shortDate($rol['updated_at']) ?>
                </td>
                <td>
                    <button><a href="<?= URL ?>/roles/editar/<?= Helper::encrypt($rol['id_role']) ?>">editar</a></button>
                    <button><a href="<?= URL ?>/roles/delete/<?= Helper::encrypt($rol['id_role']) ?>">eliminar</a></button>
                    <button><a href="<?= URL ?>/roles/manage/<?= Helper::encrypt($rol['id_role']) ?>">administrar</a></button>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</section>