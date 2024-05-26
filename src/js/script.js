document.addEventListener('DOMContentLoaded', function() {
    includeHTML();
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
