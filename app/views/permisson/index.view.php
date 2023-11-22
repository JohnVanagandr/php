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

if($_REQUEST["pagina"]==="1"){$_REQUEST["pagina"]=="0";}
        else{
            if($pagina>1)
            $ant=$_REQUEST["pagina"]-1;
            echo"<a href='" . URL . "/permisson/pagina=1><span>previus</span>";
            echo"<a href='" . URL . "/permisson/pagina=".($pagina-1)."'>".$ant."</a>";
            echo "<a> ".$_REQUEST["pagina"] ."</a> ";
        $sigui =$_REQUEST["pagina"]+1;
        $ultima =$total_registro/$registros;
        if($ultima==$_REQUEST["pagina"]+1){
            $ultima="";
        }
        if($pagina<$paginas && $paginas>1){
            echo"<a href='" . URL . "/permisson/pagina=".($pagina+1).">".$sigui."</a>";
        }  
        if($pagina<$paginas && $paginas>1){
            echo"<a href='" . URL . "/permisson/pagina=".ceil($ultima)."'></a>";    
        }

        }









    // $total_registro =13;
    // $total_paginas =ceil($total_registro/$por_pagina=12);


    // echo "<center>";

    // // Enlaces numéricos de páginas
    // for ($i = 1; $i <= $total_paginas; $i++) {
    //     echo "<a href='" . URL . "/permisson/pagina=".$i."'>".$i."</a> ";
    // }

    // // Enlace "Siguiente"
    // echo "</center>";
?>




</div>
</section>

