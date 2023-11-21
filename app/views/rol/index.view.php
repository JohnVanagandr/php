<?php
// print_r($this->permit)
?>
<section class="content-table">
    <div class="table-header">
        <div class="tittle-table">
            <h2>Roles</h2>
            <?php
            if (isset($this->permit['Crear']) && $this->permit['Crear'] === 1) {
            ?>
                <button><a href="<?= URL ?>/roles/create">nuevo</a></button>
            <?php
            }
            ?>

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

                        <?php
                        if (isset($this->permit['Editar']) && $this->permit['Editar'] === 1) {
                        ?>
                            <button><a href="<?= URL ?>/roles/editar/<?= Helper::encrypt($value['id_role']) ?>">editar</a></button>
                        <?php
                        }
                        if (isset($this->permit['Eliminar']) && $this->permit['Eliminar'] === 1) {
                        ?>
                            <button><a href="<?= URL ?>/roles/delete/<?= Helper::encrypt($value['id_role']) ?>">eliminar</a></button>
                        <?php
                        }
                        if (isset($this->permit['Administrar']) && $this->permit['Administrar'] === 1) {
                        ?>
                            <button><a href="<?= URL ?>/roles/manage/<?= Helper::encrypt($value['id_role']) ?>">administrar</a></button>
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