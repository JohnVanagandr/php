<?php

use Adso\libs\DateHelper;
use Adso\libs\Helper;



// print_r($this->permit);

if (isset($this->permit['Usuarios']) && $this->permit['Usuarios'] == 1) {
?>

    <section class="content-table">
        <div class="table-header">
            <div class="tittle-table">
                <h2>Usuarios</h2>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>apellido</th>
                    <th>Rol</th>
                    <th>telefono</th>
                    <th>Correo</th>
                    <!-- <th>Acciones</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data['users'] as $value) {
                ?>
                    <tr>
                        <td>
                            <?= $value['user_name'] ?>
                        </td>
                        <td>
                            <?= $value['last_name'] ?>
                        </td>
                        <td>
                            <?= $value['name_role'] ?>
                        </td>
                        <td>
                            <?= $value['phone'] ?>
                        </td>
                        <td>
                            <?= $value['email'] ?>
                        </td>
                        <!-- <td>
                        //<button><a href="<?= URL ?>/roles/manage/<?= Helper::encrypt($value['id_role']) ?>">Administrar</a></button>
                        </td> -->

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </section>
<?php
}
?>