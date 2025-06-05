<?php
include_once 'Model/estadisticas.php';

class EstadisticasController {
    public $dataGenero;
    public $dataFechas;

    public function obtenerDatos() {
        $estadisticas = new Estadisticas();
        $this->dataGenero = $estadisticas->getVoluntariosPorGenero();
        $this->dataFechas = $estadisticas->getFechasMasEventos();
    }
}
