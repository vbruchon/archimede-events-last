// Sélectionnez le formulaire
var filterForm = document.getElementById('filterbar');

// Attachez un écouteur d'événement sur la soumission du formulaire
filterForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Empêche le rechargement de la page

    // Effectuez le filtrage
    handleFilterChange();
});

// Fonction pour attacher les écouteurs d'événements aux éléments de filtre
function attachEventListeners() {
    var structureSelect = document.getElementById('structure');
    var statusSelect = document.getElementById('status');
    var participantSelect = document.getElementById('participants');

    structureSelect.addEventListener('change', handleFilterChange);
    statusSelect.addEventListener('change', handleFilterChange);
    participantSelect.addEventListener('change', handleFilterChange);
}

function handleFilterChange() {
    console.log("Je suis rentré dans la fonction");
    // Récupère les valeurs sélectionnées des filtres
    var selectedStructure = document.getElementById('structure').value;
    var selectedStatus = document.getElementById('status').value;
    var selectedParticipant = document.getElementById('participants').value;
    // Remplacer les espaces par des caractères valides
    var encodedStructure = selectedStructure.replaceAll(' ', '+');
    var encodedStatus = selectedStatus.replaceAll(' ', '+');
    var encodedParticipant = selectedParticipant.replaceAll(' ', '+');

    // Crée une instance de l'objet XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Définit la fonction de rappel pour la réponse de la requête AJAX
    xhr.onreadystatechange = function () {
        console.log('Ready state:', xhr.readyState);
        console.log('Status:', xhr.status);

        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Met à jour la partie <main> de la page avec la réponse HTML
                var body = document.querySelector('body');
                body.innerHTML = xhr.responseText;

                document.getElementById('structure').value = selectedStructure;
                document.getElementById('status').value = selectedStatus;
                document.getElementById('participants').value = selectedParticipant;


            } else {
                // Gère les erreurs éventuelles
                console.error('Une erreur s\'est produite lors de la requête AJAX');
            }
        }
    };

    var url = '/dashboard/events/filtered';
    var params = {
        'structure': selectedStructure,
        'status': selectedStatus,
        'participants': selectedParticipant,
    };

    // Définit la méthode, l'URL et les données à envoyer dans la requête AJAX
    xhr.open('GET', url + '?' + new URLSearchParams(params));
    xhr.send();


    // Modifier l'URL avec la nouvelle requête
    var newUrl = url + '?' + new URLSearchParams(params);
    history.pushState(null, '', newUrl);
    // location.reload();
}

// Attacher les écouteurs d'événements lors de l'initialisation de la page
attachEventListeners();


// Fonction de réinitialisation des filtres
function resetFilters() {
    // Réinitialiser les sélections des menus déroulants
    document.getElementById('structure').selectedIndex = 0;
    document.getElementById('status').selectedIndex = 0;
    document.getElementById('number_of_participants').selectedIndex = 0;

    // Soumettre le formulaire pour appliquer les filtres réinitialisés
    form.submit();
}