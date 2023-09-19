<?php
if (isset($_POST['region_id'])) {
    require_once 'conexionDB.php'; 
    $region_id = $_POST['region_id'];
    $db = new Database();
    $dataVotacion = new GetDataVotacion($db);
    
    $regiones = $dataVotacion->getComunas($region_id);
    foreach ($regiones as $region) {
        ?>
        <option value='<?php echo $region['id'];?>'> <?php echo $region['nombre'];?></option>
        <?php
    }
    if($region_id == 0){
        echo '<option value="0" selected>-Seleccione comuna-</option>';
    }
} else {
    echo json_encode(array('success' => 0));
}
?>