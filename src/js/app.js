document.addEventListener('DOMContentLoaded', function() {

    eventListeners();

    darkMode();
});
function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    const iconoDarkMode = botonDarkMode.querySelector('img');
    const preferenciaGuardada = localStorage.getItem('dark-mode');

    function actualizarIcono() {
        const modoOscuro = document.body.classList.contains('dark-mode');

        iconoDarkMode.src = modoOscuro
            ? '/build/img/sun-solid.svg'
            : '/build/img/dark-mode.svg';

        botonDarkMode.title = modoOscuro
            ? 'Activar modo claro'
            : 'Activar modo oscuro';
        
        botonDarkMode.setAttribute('aria-label', botonDarkMode.title);
    }

    if(preferenciaGuardada === 'dark') {
        document.body.classList.add('dark-mode');
    } else if(preferenciaGuardada === 'light') {
        document.body.classList.remove('dark-mode');
    } else if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    actualizarIcono();

    prefiereDarkMode.addEventListener('change', function() {
        if(!localStorage.getItem('dark-mode')) {
            document.body.classList.toggle('dark-mode');
            actualizarIcono();
        }
    });

    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem(
            'dark-mode',
            document.body.classList.contains('dark-mode') ? 'dark' : 'light'
        );
        actualizarIcono();
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    //muestra campos condicionales en formulario de contacto
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', seleccionarMetodo));
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar')
}

function seleccionarMetodo(e) {
    const contactoDiv = document.querySelector('#contacto');
    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono"></label>
            <input type="number" class="muestra" placeholder="&#xf095;" id="telefono" name="contacto[telefono]">

            <p>Elija la fecha y la hora que mejor le convenga para que le llamemos</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora (9-18h):  </label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email"></label>
            <input type="email" class="muestra" placeholder="&#xf0e0;" id="email" name="contacto[email]" required>
        `;
    }
}



