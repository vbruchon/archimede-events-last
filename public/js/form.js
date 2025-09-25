var previsionnelCheckbox = document.getElementById("no-fix");
var fixCheckbox = document.getElementById("fix");

previsionnelCheckbox.addEventListener("click", function() {
    if (previsionnelCheckbox.checked) {
        fixCheckbox.checked = false;
    } else {
        fixCheckbox.checked = true;
    }
});

fixCheckbox.addEventListener("click", function() {
    if (previsionnelCheckbox.checked) {
        previsionnelCheckbox.checked = false;
    } else {
        previsionnelCheckbox.checked = true;
    }
});

// Récupérer les références des éléments HTML
var fixCheckbox = document.getElementById('fix');
var notFixCheckbox = document.getElementById('no-fix');
var isFixDiv = document.getElementById('is_fix');
var isNotFixDiv = document.getElementById('is_not_fix');

// Fonction pour afficher/masquer les div en fonction de l'état des cases à cocher
function toggleDivVisibility() {
    if (fixCheckbox.checked) {
        isFixDiv.style.display = 'block';
        isNotFixDiv.style.display = 'none';
    } else if (notFixCheckbox.checked) {
        isFixDiv.style.display = 'none';
        isNotFixDiv.style.display = 'block';
    } else {
        isFixDiv.style.display = 'none';
        isNotFixDiv.style.display = 'none';
    }
}

// Appeler la fonction pour définir l'état initial des div
toggleDivVisibility();

// Ajouter des écouteurs d'événements pour les clics sur les cases à cocher
fixCheckbox.addEventListener('click', toggleDivVisibility);
notFixCheckbox.addEventListener('click', toggleDivVisibility);