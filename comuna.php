<?php
if (isset($_POST['region_id'])) {
    $conexion = mysqli_connect("localhost", "root", "", "votacion");
    $consulta = "SELECT * FROM comuna where region_id = " . $_POST['region_id']." order by nombre asc";
    $resultados = mysqli_query($conexion, $consulta);
    while ($fila = mysqli_fetch_assoc($resultados)) {
        ?>
        <option value='<?php echo $fila['id'];?>'> <?php echo $fila['nombre'];?></option>
        <?php
    }
    mysqli_close($conexion);
    //echo json_encode($comunas);
} else {
    echo json_encode(array('success' => 0));
}
?>