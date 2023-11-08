<h1>Administrar <?= $data["rol"]["name_role"] ?></h1>

<form action="<?= URL ?>/roles/assing" method="POST">
    <input type="hidden" name="rol" value="<?php echo($data["rol"]["id_role"])?>">
    <?php foreach ($data['permit'] as $value) {
    ?>
        <br>
        <label>
            <input type="checkbox" name="permisos[]" value="<?= $value['id_permission']?>" > <?= $value['name_permisson'] ?>
        </label>
    <?php  } ?>
    <div>
        <button type="submit">Enviar</button>
    </div>
</form>
<!-- 
$role = $this->model->getRole(["id_role" => Helper::decrypt($id)]); 
        /**Usa el metodo getPermisson de PermissonModel que a su vez usa el metodo select de 
         * Model que obtiene todos los datos de una tabla en especifico
        */
        $permit = $this->model2->getPermisson();
        /*Usa el metodo selectPermits de Permisson_RoleModel que a su vez usa el metodo getRowById 
        de Model que obtiene una fila por id
        */
        $permit_role = $this->model3->selectPermits(["id_role_fk" => $role["id_role"]]);

        $data = [
            "titulo" => "Roles",
            "subtitulo" => "Administrar permisos",
            "menu" => true,
            "rol" => $role,
            "permit" => $permit,
            "permit_role" => $permit_role
        ]; -->


<?php

// echo "<pre>";
// print_r($data['permit']);
// echo "</pre>";

// echo "<pre>";
// print_r($data['permit_role']);
// echo "</pre>";

// in_array($data['permit'],  ,false);


// for ($i=0; $i < count($data['permit']); $i++) {
    // echo "<pre>";
    // print_r($data['permit'][$i]["id_permission"]);
    // echo "</pre>";
    
    // echo "<pre>";
    // print_r($data['permit_role']);
    // echo "</pre>";

    // if(in_array($data['permit'][$i]["id_permission"],$data['permit_role'])){
    //     echo $data['permit'][$i]['name_permisson']. "esta chekeado";
        
    // }else{
    //     echo $data['permit'][$i]['name_permisson'];

    // }
    // echo "<br>";
    
// }

// foreach($data['permit'] as $value){

    

//         if(in_array($value['id_permission'],$data['permit_role'])){
//             echo $value['name_permisson']. "esta chekeado";
//         }else{
//             echo $value['name_permisson'];
//         }

    
//     echo '<br>';

// }

?>