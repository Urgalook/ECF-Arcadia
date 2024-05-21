document.querySelectorAll('.valider-btn').forEach(button => {
    button.addEventListener('click', function() {
        var idAvis = this.getAttribute('data-id');
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'validate_avis.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {

                alert(xhr.responseText);
            }
        };
        xhr.send('id=' + idAvis);
    });
});
