<?php
require_once("AccesoDatos.php");

class Voluntario {
    
    public static function obtenerPorId($id) {
      $db = new AccesoDatos();
      $db->conectar();
      $res = $db->ejecutarConsulta("SELECT * FROM voluntarios WHERE ID = " . intval($id));
      $db->desconectar();
      return $res[0] ?? null;
    }

    public static function actualizar($id, $nombre, $correo, $telefono) {
      $db = new AccesoDatos();
      $db->conectar();
      $nombre = addslashes($nombre);
      $correo = addslashes($correo);
      $telefono = addslashes($telefono);

      $sql = "UPDATE voluntarios SET NOMBRE='$nombre', CORREO='$correo', TELEFONO='$telefono' WHERE ID=$id";
      $res = $db->ejecutarComando($sql);
      $db->desconectar();
      return $res;
    }

    public static function obtenerTodos() {
    $db = new AccesoDatos();
    $db->conectar();
    $res = $db->ejecutarConsulta("SELECT * FROM voluntarios ORDER BY ID DESC");
    $db->desconectar();
    return $res;
    }

    // obtener todos los voluntarios que participan en un evento
    public static function obtenerEventosPorVoluntario($idVoluntario) {
    $db = new AccesoDatos();
    $db->conectar();
    $id = intval($idVoluntario);
    $sql = "SELECT e.NOMBRE 
            FROM voluntario_eventos ve 
            INNER JOIN eventos e ON ve.ID_EVENTO = e.ID 
            WHERE ve.ID_VOLUNTARIO = $id";
    $res = $db->ejecutarConsulta($sql);
    $db->desconectar();
    return array_column($res, "NOMBRE");
    }


    public static function eliminar($id) {
    $db = new AccesoDatos();
    $db->conectar();
    $res = $db->ejecutarComando("DELETE FROM voluntarios WHERE ID = " . intval($id));
    $db->desconectar();
    return $res;
    }


    public static function actualizarPassword($id, $nuevoHash) {
    $db = new AccesoDatos();
    $db->conectar();
    $sql = "UPDATE voluntarios SET CONTRASEÑA = '$nuevoHash' WHERE ID = $id";
    $res = $db->ejecutarComando($sql);
    $db->desconectar();
    return $res;
    }

   

}
