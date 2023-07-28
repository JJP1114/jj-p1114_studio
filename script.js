const contactForm = document.getElementById('contactForm');

contactForm.addEventListener('submit', function(event) {
    event.preventDefault();

    // Récupérer les données du formulaire
    const formData = new FormData(contactForm);

    // Envoyer les données en utilisant AJAX
    fetch('send_discord_webhook.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        // Réinitialiser le formulaire après l'envoi réussi
        contactForm.reset();
    })
    .catch(error => console.error('Erreur:', error));
});