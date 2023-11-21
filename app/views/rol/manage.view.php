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