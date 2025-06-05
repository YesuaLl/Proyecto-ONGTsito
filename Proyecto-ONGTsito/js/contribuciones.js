function mostrarOtroCampo() {
    const tipoSelect = document.getElementById('tipo');
    const campoOtro = document.getElementById('campoOtro');
    campoOtro.style.display = tipoSelect.value === 'Otro' ? 'block' : 'none';
}