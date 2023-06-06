<?php
$nombre = $_POST['name'];
$alias = $_POST['alias'];
$rut = $_POST['rut'];
$email = $_POST['email'];
$region = $_POST['region'];
$comuna = $_POST['comuna'];
$candidato = $_POST['candidato'];
$cbox1 = isset($_POST['cbox1']) ? $_POST['cbox1'] : 0;
$cbox2 = isset($_POST['cbox2']) ? $_POST['cbox2'] : 0;
$cbox3 = isset($_POST['cbox3']) ? $_POST['cbox3'] : 0;
$cbox4 = isset($_POST['cbox4']) ? $_POST['cbox4'] : 0;

$conexion = mysqli_connect("localhost", "root", "", "votacion");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
$existe = mysqli_query($conexion, "SELECT * from usuario WHERE rut = '" . $rut . "'");
if (mysqli_num_rows($existe) > 0) {
    echo 0;
} else {
    $conexion->begin_transaction();
    try {
        $insertUsuario = "INSERT INTO usuario (nombre, alias, rut, email, region_id, comuna_id, id_candidato)
        VALUES ('$nombre', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato')";
        $conexion->query($insertUsuario);

        $id_usuario = $conexion->insert_id;
        if ($cbox1 > 0) {
            $sql = 'INSERT INTO usuario_medio_captacion (id_medio_captacion, id_usuario) values(' . $cbox1 . ',' . $id_usuario . ')';
            $conexion->query($sql);
        }
        if ($cbox2 > 0) {
            $sql = 'INSERT INTO usuario_medio_captacion (id_medio_captacion, id_usuario) values(' . $cbox2 . ',' . $id_usuario . ')';
            $conexion->query($sql);
        }
        if ($cbox3 > 0) {
            $sql = 'INSERT INTO usuario_medio_captacion (id_medio_captacion, id_usuario) values(' . $cbox3 . ',' . $id_usuario . ')';
            $conexion->query($sql);
        }
        if ($cbox4 > 0) {
            $sql = 'INSERT INTO usuario_medio_captacion (id_medio_captacion, id_usuario) values(' . $cbox4 . ',' . $id_usuario . ')';
            $conexion->query($sql);
        }
        $conexion->commit();
        echo 1;
    } catch (Exception $e) {
        // En caso de error, deshacer la transacción
        $conexion->rollback();
        echo "Error al insertar datos: " . $e->getMessage();
    }
}
$conexion->close();
?>