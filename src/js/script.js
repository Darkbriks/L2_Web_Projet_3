document.addEventListener('DOMContentLoaded', function() {
    includeHTML();
    initializeTheme();
    document.getElementById('theme').addEventListener('click', theme);

});

function includeHTML() {
    const elements = document.querySelectorAll('[data-include]');

    elements.forEach(element => {
        const file = element.getAttribute('data-include');

        fetch(file)
            .then(response => response.text())
            .then(data => {
                element.innerHTML = data;
            })
            .catch(error => {
                console.error('Erreur:', error);
                element.innerHTML = '<p>Erreur lors du chargement du contenu.</p>';
            });
    });
}
function initializeTheme() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.body.classList.add(`${savedTheme}-theme`);
}

function theme() {
    if (document.body.classList.contains('light-theme')) {
        document.body.classList.replace('light-theme', 'dark-theme');
        document.getElementById('theme').innerHTML = 'Light mode';
        localStorage.setItem('theme', 'dark');
    } else {
        document.body.classList.replace('dark-theme', 'light-theme');
        document.getElementById('theme').innerHTML = 'Dark mode'
        localStorage.setItem('theme', 'light');
    }
}
