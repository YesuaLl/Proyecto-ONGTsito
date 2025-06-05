document.addEventListener('DOMContentLoaded', function() {
    // Capturar todos los enlaces de Editar y Eliminar
    const editarLinks = document.querySelectorAll('a[href*="accion=editar"]');
    const eliminarLinks = document.querySelectorAll('a[href*="accion=eliminar"]');

    function crearPopup(mensaje, url) {
        // Crear fondo del popup
        const fondo = document.createElement('div');
        fondo.style.position = 'fixed';
        fondo.style.top = 0;
        fondo.style.left = 0;
        fondo.style.width = '100vw';
        fondo.style.height = '100vh';
        fondo.style.backgroundColor = 'rgba(0,0,0,0.5)';
        fondo.style.display = 'flex';
        fondo.style.justifyContent = 'center';
        fondo.style.alignItems = 'center';
        fondo.style.zIndex = 1000;

        // Crear caja del popup
        const caja = document.createElement('div');
        caja.style.backgroundColor = 'white';
        caja.style.padding = '20px';
        caja.style.borderRadius = '5px';
        caja.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';
        caja.style.textAlign = 'center';
        caja.style.maxWidth = '300px';

        // Mensaje
        const texto = document.createElement('p');
        texto.textContent = mensaje;
        caja.appendChild(texto);

        // Botones
        const btnAceptar = document.createElement('button');
        btnAceptar.textContent = 'Aceptar';
        btnAceptar.classList.add('btn-aceptar');

        const btnCancelar = document.createElement('button');
        btnCancelar.textContent = 'Cancelar';
        btnCancelar.classList.add('btn-cancelar');

        caja.appendChild(btnAceptar);
        caja.appendChild(btnCancelar);
        fondo.appendChild(caja);
        document.body.appendChild(fondo);

        // Acciones botones
        btnAceptar.addEventListener('click', () => {
            window.location.href = url;
        });

        btnCancelar.addEventListener('click', () => {
            document.body.removeChild(fondo);
        });
    }

    // Editar: muestra popup antes de ir a la edición
    editarLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            crearPopup('¿Quieres editar este evento?', this.href);
        });
    });

    // Eliminar: muestra popup antes de eliminar
    eliminarLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            crearPopup('¿Estás seguro que deseas eliminar este evento?', this.href);
        });
    });
});
