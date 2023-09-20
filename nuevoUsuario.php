<?php
require_once 'conexionDB.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $dataVotacion = new InsertDataVotacion($db);

    $nombre     = $_POST['name'];
    $alias      = $_POST['alias'];
    $rut        = $_POST['rut'];
    $email      = $_POST['email'];
    $comuna     = $_POST['comuna'];
    $candidato  = $_POST['candidato'];
    
    $cbox1 = isset($_POST['cbox1']) ? $_POST['cbox1'] : 0;
    $cbox2 = isset($_POST['cbox2']) ? $_POST['cbox2'] : 0;
    $cbox3 = isset($_POST['cbox3']) ? $_POST['cbox3'] : 0;
    $cbox4 = isset($_POST['cbox4']) ? $_POST['cbox4'] : 0;
    $resultado = $dataVotacion->insertarUsuario($nombre, $alias, $rut, $email, $comuna, $candidato, $cbox1, $cbox2, $cbox3, $cbox4);
    echo $resultado;
}

?>