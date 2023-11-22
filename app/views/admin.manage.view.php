<?php

use Adso\libs\DateHelper;
use Adso\libs\Helper;

?>
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title text-center">Cambiar Rol</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= URL ?>/roles/updateRolUser/<?= Helper::encrypt($data['user_id']) ?>">
                        <div class="form-group">
                            <label for="TipoRol">Seleccionar Rol:</label>
                            <select class="form-control" name="TipoRol" id="TipoRol">
                                <option value="1">Admin</option>
                                <option value="2">Usuario</option>
                            </select>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Actualizar Rol</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
