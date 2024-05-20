// Script JavaScript pour envoyer une requête AJAX lors du clic sur le bouton "Valider"
document.querySelectorAll('.valider-btn').forEach(button => {
    button.addEventListener('click', function() {
        var idAvis = this.getAttribute('data-id');
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'validate_avis.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Gérer la réponse ici si nécessaire
                alert(xhr.responseText);
            }
        };
        xhr.send('id=' + idAvis);
    });
});
