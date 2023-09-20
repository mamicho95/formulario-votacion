<?php
class Database {
    const HOST = "localhost";
    const USERNAME = "root";
    const PASSWORD = "root";
    const DATABASE = "votacion";
    private $connection;

    public function __construct() {
        $this->connection = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASE);
        if ($this->connection->connect_error) {
            die("Error de conexión: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    public function close() {
        $this->connection->close();
    }
}

class GetDataVotacion {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getComunas($regionId) {
        $sql = "SELECT * FROM comuna WHERE region_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $regionId);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $comunas = array();
        while ($fila = $resultados->fetch_assoc()) {
            $comunas[] = $fila;
        }
        $stmt->close();
        return $comunas;
    }
    public function getRegiones() {
        $sql = "SELECT * FROM region order by orden asc";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $regiones = array();
        while ($fila = $resultados->fetch_assoc()) {
            $regiones[] = $fila;
        }
        $stmt->close();
        return $regiones;
    }

    public function getCandidatos() {
        $sql = "SELECT * FROM candidato";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->get_result();
        $candidatos = array();
        while ($fila = $resultados->fetch_assoc()) {
            $candidatos[] = $fila;
        }
        $stmt->close();
        return $candidatos;
    }
}
class InsertDataVotacion {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertarUsuario($nombre, $alias, $rut, $email, $comuna, $candidato, $cbox1, $cbox2, $cbox3, $cbox4) {
        try {
            $conexion = $this->db->getConnection();
            $existe = $conexion->prepare("SELECT * FROM usuario WHERE rut = ?");
            $existe->bind_param("s", $rut);
            $existe->execute();
            $resultados = $existe->get_result();
            if ($resultados->num_rows > 0) {
                return 0; 
            }

            $conexion->begin_transaction();

            $insertUsuario = "INSERT INTO usuario (nombre, alias, rut, email, comuna_id, id_candidato)
            VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($insertUsuario);
            $stmt->bind_param("ssssii", $nombre, $alias, $rut, $email, $comuna, $candidato);
            $stmt->execute();

            $id_usuario = $stmt->insert_id;
            $stmt->close();

            if ($cbox1 > 0) {
                $sql = 'INSERT INTO usuario_medio_captacion (id_medio_captacion, id_usuario) VALUES (?, ?)';
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("ii", $cbox1, $id_usuario);
                $stmt->execute();
                $stmt->close();
            }

            if ($cbox2 > 0) {
                $sql = 'INSERT INTO usuario_medio_captacion (id_medio_captacion, id_usuario) VALUES (?, ?)';
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("ii", $cbox2, $id_usuario);
                $stmt->execute();
                $stmt->close();
            }
            if ($cbox3 > 0) {
                $sql = 'INSERT INTO usuario_medio_captacion (id_medio_captacion, id_usuario) VALUES (?, ?)';
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("ii", $cbox3, $id_usuario);
                $stmt->execute();
                $stmt->close();
            }
            if ($cbox4 > 0) {
                $sql = 'INSERT INTO usuario_medio_captacion (id_medio_captacion, id_usuario) VALUES (?, ?)';
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("ii", $cbox4, $id_usuario);
                $stmt->execute();
                $stmt->close();
            }
            $conexion->commit();
            return 1; 
        } catch (Exception $e) {
            
            echo $e->getMessage();
            if (isset($conexion)) {
                $conexion->rollback();
            }
            return -1; 
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }
}

?>