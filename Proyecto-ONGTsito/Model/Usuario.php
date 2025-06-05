<?php
/************************************************************
    * Usuario.php
    * Objetivo: Clase para manejar el acceso de usuarios (administradores y voluntarios)
*****************************************************************/
include_once("Model/AccesoDatos.php");

class Usuario {
    // === Bloque 1: Login ===
    private $usuario;
    private $contrasena;
    private $rol;

    public function setUsuario($usuario) { $this->usuario = $usuario; }
    public function setContrasena($contrasena) { $this->contrasena = $contrasena; }
    public function getUsuario() { return $this->usuario; }
    public function getRol() { return $this->rol; }

    public function validarLogin() {
    $db = new AccesoDatos();
    $bRet = false;

    if ($db->conectar()) {
        $pdo = $db->getConexion();

        // Buscar voluntario
        $sql = "SELECT id, CORREO, NOMBRE, APELLIDOPATERNO, APELLIDOMATERNO, CONTRASEÑA FROM voluntarios WHERE CORREO = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->usuario]);
        $voluntario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($voluntario && password_verify($this->contrasena, $voluntario["CONTRASEÑA"])) {
            $this->rol = "voluntario";
            $this->usuario = $voluntario["CORREO"];
            $_SESSION["id_voluntario"] = $voluntario["id"];
            $_SESSION["nombre_voluntario"] = $voluntario["NOMBRE"];
            $_SESSION["ap_paterno_voluntario"] = $voluntario["APELLIDOPATERNO"];
            $_SESSION["ap_materno_voluntario"] = $voluntario["APELLIDOMATERNO"];
           
            $bRet = true;
        } else {
            // Buscar admin
            $sql = "SELECT NOMBREUSUARIO, CONTRASEÑA FROM administrador WHERE NOMBREUSUARIO = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$this->usuario]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin && password_verify($this->contrasena, $admin["CONTRASEÑA"])) {
                $this->rol = "admin";
                $this->usuario = $admin["NOMBREUSUARIO"];
                $_SESSION["esAdmin"] = true;
                $bRet = true;
            }
        }

        $db->desconectar();
    }

    return $bRet;
}


    // === Bloque 2: CRUD de voluntarios (estático) ===

    public static function obtenerTodosVoluntarios() {
        $db = new AccesoDatos();
        $db->conectar();
        $res = $db->ejecutarConsulta("SELECT * FROM voluntarios ORDER BY ID");
        $db->desconectar();
        return $res;
    }

    public static function obtenerPorId($id) {
        $db = new AccesoDatos();
        $db->conectar();
        $res = $db->ejecutarConsulta("SELECT * FROM voluntarios WHERE ID = " . intval($id));
        $db->desconectar();
        return $res[0] ?? null;
    }

    public static function actualizarContrasena($id, $nuevaContrasena) {
        $db = new AccesoDatos();
        $db->conectar();
        $hash = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
        $sql = "UPDATE voluntarios SET CONTRASEÑA = '$hash' WHERE ID = " . intval($id);
        $res = $db->ejecutarComando($sql);
        $db->desconectar();
        return $res;
    }

    public static function eliminar($id) {
        $db = new AccesoDatos();
        $db->conectar();
        $res = $db->ejecutarComando("DELETE FROM voluntarios WHERE ID = " . intval($id));
        $db->desconectar();
        return $res;
    }

    public static function correoExiste($correo) {
        $db = new AccesoDatos();
        $db->conectar();
        $stmt = $db->getConexion()->prepare("SELECT ID FROM voluntarios WHERE CORREO = ?");
        $stmt->execute([$correo]);
        $res = $stmt->fetch();
        $db->desconectar();
        return $res ? true : false;
    }

    public static function registrar($data) {
        $db = new AccesoDatos();
        $db->conectar();
        $sql = "INSERT INTO voluntarios 
                (NOMBRE, APELLIDOPATERNO, APELLIDOMATERNO, CORREO, SEXO, TELEFONO, CONTRASEÑA)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->getConexion()->prepare($sql);
        $res = $stmt->execute([
            $data["NOMBRE"],
            $data["APELLIDOPATERNO"],
            $data["APELLIDOMATERNO"],
            $data["CORREO"],
            $data["SEXO"],
            $data["TELEFONO"],
            $data["CONTRASENA"]
        ]);
        $db->desconectar();
        return $res;
    }

    public static function obtenerPorCorreo($correo) {
    $db = new AccesoDatos();
    $db->conectar();
    $stmt = $db->getConexion()->prepare("SELECT * FROM voluntarios WHERE CORREO = ?");
    $stmt->execute([$correo]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $db->desconectar();
    return $res ?: null;
}

}
