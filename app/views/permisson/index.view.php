<section class="content-table">
    <div class="table-header">
        <div class="tittle-table">
            <h2>Permisos</h2>
            <?php
            if (isset($this->permit['Crear']) && $this->permit['Crear'] === 1) {
            ?>
                <button><a href="<?= URL ?>/permisson/create">nuevo</a></button>
            <?php
            }
            ?>
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
                        <?php
                        if (isset($this->permit['Editar']) && $this->permit['Editar'] === 1) {
                        ?>
                            <button><a href="<?= URL ?>/permisson/editar/<?= Helper::encrypt($value['id_permission']) ?>">editar</a></button>
                        <?php
                        }
                        if (isset($this->permit['Eliminar']) && $this->permit['Eliminar'] === 1) {
                        ?>
                            <button><a href="<?= URL ?>/permisson/delete/<?= Helper::encrypt($value['id_permission']) ?>">eliminar</a></button>
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

</section>