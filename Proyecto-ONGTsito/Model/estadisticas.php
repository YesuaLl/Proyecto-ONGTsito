<?php
include_once 'Model/AccesoDatos.php';

class Estadisticas {
    private $accesoDatos;

    public function __construct() {
        $this->accesoDatos = new AccesoDatos();
        $this->accesoDatos->conectar();
    }

    public function getVoluntariosPorGenero() {
        $sql = "SELECT sexo AS genero, COUNT(*) as cantidad FROM voluntarios GROUP BY sexo";
        return $this->accesoDatos->ejecutarConsulta($sql);
    }

    public function getFechasMasEventos() {
        $sql = "SELECT fecha, COUNT(*) as cantidad FROM eventos GROUP BY fecha ORDER BY cantidad DESC LIMIT 5";
        return $this->accesoDatos->ejecutarConsulta($sql);
    }
}
