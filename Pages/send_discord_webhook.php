<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Construire le message à envoyer sur Discord
    $hookUrl = "https://discord.com/api/webhooks/WEBHOOK_ID/WEBHOOK_TOKEN"; // Remplacez WEBHOOK_ID et WEBHOOK_TOKEN par les valeurs de votre webhook Discord
    $hookMessage = "Nouveau message de contact de votre site :\n\n";
    $hookMessage .= "Nom : " . $name . "\n";
    $hookMessage .= "Email : " . $email . "\n";
    $hookMessage .= "Message : " . $message;

    // Configurer la requête HTTP pour envoyer le message à Discord
    $ch = curl_init($hookUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('content' => $hookMessage));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Exécuter la requête HTTP
    $response = curl_exec($ch);

    // Vérifier si la requête a réussi
    if (curl_errno($ch)) {
        // Gérer les erreurs éventuelles
        $error_message = curl_error($ch);
        echo "Erreur cURL : " . $error_message;
    } else {
        // Afficher la réponse du serveur Discord (pour le débogage)
        echo $response;
    }

    // Fermer la session cURL
    curl_close($ch);

    // Réponse JSON pour le traitement côté JavaScript (facultatif)
    $response = array('success' => true, 'message' => 'Le message a été envoyé avec succès!');
    echo json_encode($response);
}
?>