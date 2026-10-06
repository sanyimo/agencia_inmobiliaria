document.addEventListener('DOMContentLoaded', function() {

    eventListeners();

    darkMode();
});
function darkMode() {

    const prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    const btnDarkMode = document.querySelector('.dark-mode-btn');
    const iconDarkMode = btnDarkMode.querySelector('img');
    const savedPreference = localStorage.getItem('dark-mode');

    function updateIcon() {
        const modeDarkMode = document.body.classList.contains('dark-mode');

        iconDarkMode.src = modeDarkMode
            ? '/build/img/sun-solid.svg'
            : '/build/img/dark-mode.svg';

        btnDarkMode.title = modeDarkMode
            ? 'Activar modo claro'
            : 'Activar modo oscuro';
        
        btnDarkMode.setAttribute('aria-label', btnDarkMode.title);
    }

    if (savedPreference === 'dark') {
        document.body.classList.add('dark-mode');
    } else if (savedPreference === 'light') {
        document.body.classList.remove('dark-mode');
    } else if (prefersDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    updateIcon();

    prefersDarkMode.addEventListener('change', function () {
        if(!localStorage.getItem('dark-mode')) {
            document.body.classList.toggle('dark-mode');
            updateIcon();
        }
    });

    btnDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem(
            'dark-mode',
            document.body.classList.contains('dark-mode') ? 'dark' : 'light'
        );
        updateIcon();
    });
}

function eventListeners() {
    const phoneMenu = document.querySelector('.hamburger-menu');

    phoneMenu.addEventListener('click', responsiveNavegation);

    //muestra campos condicionales en formulario de contact
    const contactMethod = document.querySelectorAll('input[name="contact[contact]"]');
    contactMethod.forEach(input => input.addEventListener('click', selectMethod));
}

function responsiveNavegation() {
    const navegation = document.querySelector('.navegation');
    navegation.classList.toggle('show')
}

function selectMethod(e) {
    const contactDiv = document.querySelector('#contact');
    if (e.target.value === 'phone') {
        contactDiv.innerHTML = `
            <label for="phone"></label>
            <input type="number" class="sample" placeholder="&#xf095;" id="phone" name="contact[phone]">

            <p>Elija la fecha y la hora que mejor le convenga para que le llamemos</p>

            <label for="date">Fecha:</label>
            <input type="date" id="date" name="contact[fecha]">

            <label for="hour">Hora (9-18h):  </label>
            <input type="time" id="hour" min="09:00" max="18:00" name="contact[hora]">
        `;
    } else {
        contactDiv.innerHTML = `
            <label for="email"></label>
            <input type="email" class="sample" placeholder="&#xf0e0;" id="email" name="contact[email]" required>
        `;
    }
}



