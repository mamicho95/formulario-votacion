<?php
require_once 'conexionDB.php';
$db = new Database();
$dataVotacion = new GetDataVotacion($db);

$regiones = $dataVotacion->getRegiones();
$candidatos = $dataVotacion->getCandidatos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="validaciones.js"></script>
    <script src="funciones.js"></script>
    <title>Formulario de Votacion</title>
</head>
<body>
    <div class="votacion">
        <form id="formulario" class="form" method="post">
        <div class="titulo">
                        <h1>Formulario de Votación</h1>
                        <img src="imagenes/votacion.png" alt="icono" width="50px">
                    </div>
            <table border="0px">

                <tr>
                    <td>
                        <label for="name">Nombre y Apellido</label>
                    </td>
                    <td>
                        <input class="campo" id="name" name="name" type="text">
                        <label id="valname" class="valmensaje" for="name">No debe quedar en blanco.</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="alias">Alias</label>
                    </td>
                    <td>
                        <input class="campo" id="alias" name="alias" type="text">
                        <label id="valalias" class="valmensaje" for="alias">Debe contener mas de 5 caracteres, letras y
                            números.</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input class="campo" id="email" name="email" type="text"  placeholder="">
                        <label id="valemail" class="valmensaje" for="email">Email no valido.</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rut">RUT</label>
                    </td>
                    <td>
                        <input class="campo" id="rut" name="rut" type="text"  placeholder="">
                        <label id="valrut" class="valmensaje" for="rut">RUT no valido.</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="region">Región</label>
                    </td>
                    <td>
                        <select class="campo" id="region" name="region" onchange="getComuna(this.value)">
                            <option value="0" selected>-Seleccione region-</option>
                            <?php
                            foreach ($regiones as $region) {
                                echo "<option value='" . $region['id'] . "'>" . $region['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                        <label id="valregion" class="valmensaje" for="region">Debe seleccionar una región</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="comuna">Comuna</label>
                    </td>
                    <td>
                        <select class="campo" id="comuna" name="comuna">
                            <option value="0" selected>-Seleccione comuna-</option>
                        </select>
                        <label class="valmensaje" for="comuna">-</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Candidato">Candidato</label>
                    </td>
                    <td>
                        <select class="campo" id="candidato" name="candidato" >
                            <option value="0" selected>-Seleccione candidato-</option>
                            
                            <?php
                            foreach ($candidatos as $candidato) {
                                echo "<option value='" . $candidato['id'] . "'>" . $candidato['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                        <label id="valcandidato" class="valmensaje" for="candidato">Debe seleccionar un candidato</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Como se entero de Nosotros</label>
                    </td>
                    <td class="checks-captacion">
                        <label><input type="checkbox" name="cbox1" value="1">Web</label>
                        <label><input type="checkbox" name="cbox2" value="2">TV</label>
                        <label><input type="checkbox" name="cbox3" value="3">Redes Sociales</label>
                        <label><input type="checkbox" name="cbox4" value="4">Amigo</label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><label id="valcheckbox" class="valmensaje">Debe elegir al menos dos opciones.</label></td>
                </tr>
                <tr>
                    <td colspan="2" class="votar">
                        <button>Votar</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>