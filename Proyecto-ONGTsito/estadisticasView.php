<div style="max-width: 800px; margin: 50px auto;">
    <h2 style="text-align:center;">Estadísticas de Voluntarios</h2>
    <canvas id="graficoGenero" width="400" height="200"></canvas>

    <h2 style="text-align:center; margin-top:50px;">Fechas con Más Eventos</h2>
    <canvas id="graficoFechas" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const generoLabels = <?= json_encode(array_column($dataGenero, 'genero')); ?>;
    const generoData = <?= json_encode(array_column($dataGenero, 'cantidad')); ?>;
    const fechaLabels = <?= json_encode(array_column($dataFechas, 'fecha')); ?>;
    const fechaData = <?= json_encode(array_column($dataFechas, 'cantidad')); ?>;
</script>
<script src="js/estadisticas.js"></script>
