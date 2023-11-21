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
<?php

$total_registro = count($data['permisos']);
$total_paginas = ceil($total_registro);


echo "<center><a href='" . URL . "/permisson/index=1'>Anterior</a>";

// Enlaces numéricos de páginas
for ($i = 1; $i <= $total_paginas; $i++) {
    echo "<a href='" . URL . "/permisson/index=$i'>$i</a> ";
}

// Enlace "Siguiente"
echo "<a href='" . URL . "/permisson/index=$total_paginas'>Siguiente</a></center>";
?>




</div>
</section>

