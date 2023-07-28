<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Webhook URL de Discord (remplacez 'WEBHOOK_URL' par votre URL de webhook réelle)
    $webhook_url = 'https://discord.com/api/webhooks/1134506169931661342/w5We2ZlQPtL3p2gzQUbeBaBeh16fAvdVlBKls6gSXbtQYFYFFbQEj-NWEExLhhIjAb0h';

    // Construire le contenu du message à envoyer à Discord
    $discord_message = "Nouveau message de contact :\n";
    $discord_message .= "Nom : $name\n";
    $discord_message .= "Email : $email\n";
    $discord_message .= "Message : $message\n";

    // Préparer les données pour l'envoi POST au webhook
    $data = array('content' => $discord_message);

    // Utiliser cURL pour envoyer les données au webhook Discord
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Réponse JSON pour le traitement côté JavaScript (facultatif)
    $response = array('success' => true, 'message' => 'Le message a été envoyé avec succès!');
    echo json_encode($response); 
}
else {
    // Répondre par une erreur 405 si ce n'est pas une demande POST
    http_response_code(405);
    echo "Method Not Allowed";
}
?>