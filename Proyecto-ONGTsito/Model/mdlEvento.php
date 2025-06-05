<?php
require_once("AccesoDatos.php");

class Evento {
    // Obtener todos los eventos
    public static function obtenerTodos() {
        $oAD = new AccesoDatos();
        $oAD->conectar();
        $result = $oAD->ejecutarConsulta("SELECT * FROM eventos ORDER BY FECHA DESC");
        $oAD->desconectar();
        return $result;
    }

    // Obtener un evento por ID
    public static function obtenerPorId($id) {
        $oAD = new AccesoDatos();
        $oAD->conectar();
        $res = $oAD->ejecutarConsulta("SELECT * FROM eventos WHERE ID = " . intval($id));
        $oAD->desconectar();
        return $res[0] ?? null;
    }

    public static function unirseEvento($idVoluntario, $idEvento) {
    $db = new AccesoDatos();
    $db->conectar();

    // Evita duplicados
    $check = $db->ejecutarConsulta("SELECT * FROM voluntario_eventos WHERE ID_VOLUNTARIO = $idVoluntario AND ID_EVENTO = $idEvento");
    if (count($check) === 0) {
        $fecha = date("Y-m-d H:i:s");
        $sql = "INSERT INTO voluntario_eventos (ID_VOLUNTARIO, ID_EVENTO, FECHA_UNION)
                VALUES ($idVoluntario, $idEvento, '$fecha')";
        $db->ejecutarComando($sql);
    }

    $db->desconectar();
    }

    public static function obtenerEventosPorVoluntario($idVoluntario) {
    $db = new AccesoDatos();
    $db->conectar();

    $sql = "SELECT e.* FROM eventos e 
            INNER JOIN voluntario_eventos ve ON e.ID = ve.ID_EVENTO
            WHERE ve.ID_VOLUNTARIO = " . intval($idVoluntario) . "
            ORDER BY e.FECHA DESC";

    $res = $db->ejecutarConsulta($sql);
    $db->desconectar();
    return $res;
    }


    // Crear un nuevo evento
    public static function crear($nombre, $fecha, $hora, $imagen, $admin) {
        $oAD = new AccesoDatos();
        $oAD->conectar();
        $nombre = addslashes($nombre);
        $imagen = addslashes($imagen);
        $sql = "INSERT INTO eventos (NOMBRE, FECHA, HORA, IMAGEN, ADMIN_USUARIO)
                VALUES ('$nombre', '$fecha', '$hora', '$imagen', '$admin')";
        $res = $oAD->ejecutarComando($sql);
        $oAD->desconectar();
        return $res;
    }

    // Actualizar un evento por ID
    // Este método recibe el ID del evento, el nuevo nombre, fecha, hora, imagen y el usuario administrador     
    public static function actualizar($id, $nombre, $fecha, $hora, $imagen, $admin) {
        $oAD = new AccesoDatos();
        $oAD->conectar();
        $nombre = addslashes($nombre);
        $imagen = addslashes($imagen);
        $sql = "UPDATE eventos SET NOMBRE='$nombre', FECHA='$fecha', HORA='$hora', IMAGEN='$imagen', ADMIN_USUARIO='$admin' WHERE ID=" . intval($id);
        $res = $oAD->ejecutarComando($sql);
        $oAD->desconectar();
        return $res;
    }

    // Eliminar un evento por ID
    public static function eliminar($id) {
        $oAD = new AccesoDatos();
        $oAD->conectar();
        $res = $oAD->ejecutarComando("DELETE FROM eventos WHERE ID = " . intval($id));
        $oAD->desconectar();
        return $res;
    }


    //verifica si un voluntario está unido a un evento
    public static function yaSeUnio($idVoluntario, $idEvento) {
        $db = new AccesoDatos();
        $db->conectar();
        $sql = "SELECT 1 FROM voluntario_eventos WHERE ID_VOLUNTARIO = $idVoluntario AND ID_EVENTO = $idEvento";
        $res = $db->ejecutarConsulta($sql);
        $db->desconectar();
        return count($res) > 0;
    }

    public static function abandonarEvento($idVoluntario, $idEvento) {
        $db = new AccesoDatos();
        $db->conectar();
        $sql = "DELETE FROM voluntario_eventos WHERE ID_VOLUNTARIO = $idVoluntario AND ID_EVENTO = $idEvento";
        $res = $db->ejecutarComando($sql);
        $db->desconectar();
        return $res;
    }


}
