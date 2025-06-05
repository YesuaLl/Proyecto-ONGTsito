<?php
/*********************/
/* AccesoDatos.php
 * Objetivo: clase que encapsula el acceso a la base de datos tsito (caso PDO)
 *********************/
error_reporting(E_ALL); // Notifica todos los errores

class AccesoDatos {
    private $oConexion = null;

    // Conecta a la base de datos tsito
    public function conectar() {
        $bRet = false;
        try {
            $this->oConexion = new PDO(
                "mysql:host=localhost;dbname=tsito1", "root", "",
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")
            );
            $this->oConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bRet = true;
        } catch (PDOException $e) {
            // MOSTRAR ERROR DETALLADO PARA DEPURACIÓN
            die("<strong>Error al conectar con la base de datos:</strong><br>" . $e->getMessage());
        }
        return $bRet;
    }

    // Desconecta de la base de datos
    public function desconectar() {
        if ($this->oConexion != null) {
            $this->oConexion = null;
        }
        return true;
    }

    // Ejecuta una consulta SELECT y devuelve los resultados en un arreglo
    public function ejecutarConsulta($psConsulta) {
        $arrRS = [];
        $rst = null;

        if (empty($psConsulta)) {
            throw new Exception("AccesoDatos->ejecutarConsulta: falta indicar la consulta");
        }

        if ($this->oConexion == null) {
            throw new Exception("AccesoDatos->ejecutarConsulta: falta conectar la base");
        }

        try {
            $rst = $this->oConexion->query($psConsulta);
        } catch (Exception $e) {
            throw $e;
        }

        if ($rst) {
            $arrRS = $rst->fetchAll(PDO::FETCH_ASSOC);
        }

        return $arrRS;
    }

    // Ejecuta comandos como INSERT, UPDATE, DELETE y devuelve el número de filas afectadas
    public function ejecutarComando($psComando) {
        if (empty($psComando)) {
            throw new Exception("AccesoDatos->ejecutarComando: falta indicar el comando");
        }

        if ($this->oConexion == null) {
            throw new Exception("AccesoDatos->ejecutarComando: falta conectar la base");
        }

        try {
            return $this->oConexion->exec($psComando);
        } catch (Exception $e) {
            throw $e;
        }
    }

    // Permite obtener la conexión por si se requiere en otras clases
    public function getConexion() {
        return $this->oConexion;
    }
}
?>
