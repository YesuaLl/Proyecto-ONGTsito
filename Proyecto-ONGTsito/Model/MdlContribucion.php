<?php
require_once("AccesoDatos.php");

class Contribucion {
    // Obtener todas las contribuciones junto con el nombre del evento (para admin)
    public static function obtenerTodasConEvento() {
        $db = new AccesoDatos();
        $db->conectar();

        $sql = "SELECT c.*, e.NOMBRE AS NOMBRE_EVENTO 
                FROM contribuciones c
                LEFT JOIN eventos e ON c.ID_EVENTO = e.ID
                ORDER BY c.ID DESC";
        $res = $db->ejecutarConsulta($sql);
        $db->desconectar();
        return $res;
    }

    // Crear una contribución
    public static function crear($nombre, $app, $apm, $tipo, $id_voluntario = null, $id_evento = null) {
        $db = new AccesoDatos();
        $db->conectar();

        $nombre = addslashes($nombre ?? '');
        $app = addslashes($app ?? '');
        $apm = addslashes($apm ?? '');
 
        $tipo = addslashes($tipo ?? '');

        $idVol = is_numeric($id_voluntario) ? $id_voluntario : "NULL";
        $idEvento = is_numeric($id_evento) ? $id_evento : "NULL";

        $sql = "INSERT INTO contribuciones 
                (NOMBRE, APELLIDOPATERNO, APELLIDOMATERNO, TIPODECONTRIBUCION, ID_VOLUNTARIO, ID_EVENTO)
                VALUES ('$nombre', '$app', '$apm', '$tipo', $idVol, $idEvento)";
        
        $res = $db->ejecutarComando($sql);
        $db->desconectar();
        return $res;
    }

    // Eliminar contribución
    public static function eliminar($id) {
        $db = new AccesoDatos();
        $db->conectar();
        $res = $db->ejecutarComando("DELETE FROM contribuciones WHERE ID = " . intval($id));
        $db->desconectar();
        return $res;
    }

    // Obtener contribución por ID
    public static function obtenerPorId($id) {
        $db = new AccesoDatos();
        $db->conectar();
        $res = $db->ejecutarConsulta("SELECT * FROM contribuciones WHERE ID = " . intval($id));
        $db->desconectar();
        return $res[0] ?? null;
    }

    // Actualizar contribución
    public static function actualizar($id, $nombre, $app, $apm, $tipo, $id_evento = null) {
        $db = new AccesoDatos();
        $db->conectar();

        $nombre = addslashes($nombre ?? '');
        $app = addslashes($app ?? '');
        $apm = addslashes($apm ?? '');

        $tipo = addslashes($tipo ?? '');
        $idEvento = is_numeric($id_evento) ? $id_evento : "NULL";

        $sql = "UPDATE contribuciones SET 
                NOMBRE = '$nombre',
                APELLIDOPATERNO = '$app',
                APELLIDOMATERNO = '$apm',
                
                TIPODECONTRIBUCION = '$tipo',
                ID_EVENTO = $idEvento
                WHERE ID = " . intval($id);
        
        $res = $db->ejecutarComando($sql);
        $db->desconectar();
        return $res;
    }

    // Obtener contribuciones por voluntario (solo las propias)
    public static function obtenerPorVoluntario($idVoluntario) {
        $db = new AccesoDatos();
        $db->conectar();

        $sql = "SELECT c.*, e.NOMBRE AS NOMBRE_EVENTO 
                FROM contribuciones c 
                LEFT JOIN eventos e ON c.ID_EVENTO = e.ID
                WHERE c.ID_VOLUNTARIO = " . intval($idVoluntario) . "
                ORDER BY c.ID DESC";
        
        $res = $db->ejecutarConsulta($sql);
        $db->desconectar();
        return $res;
    }

    // Obtener eventos disponibles para el formulario
    public static function obtenerEventosDisponibles() {
        $db = new AccesoDatos();
        $db->conectar();

        $sql = "SELECT ID, NOMBRE FROM eventos ORDER BY NOMBRE ASC";
        $res = $db->ejecutarConsulta($sql);
        $db->desconectar();
        return $res;
    }
}
