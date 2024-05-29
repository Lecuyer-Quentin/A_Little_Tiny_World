<?php
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    (isset($_POST['nom']) && !empty($_POST['nom'])) ? $nom = $_POST['nom'] : $errors[] = 'Veuillez renseigner votre nom';
    (isset($_POST['prenom']) && !empty($_POST['prenom'])) ? $prenom = $_POST['prenom'] : $errors[] = 'Veuillez renseigner votre prénom';
    (isset($_POST['email']) && !empty($_POST['email'])) ? $email = $_POST['email'] : $errors[] = 'Veuillez renseigner votre email';
    (isset($_POST['message']) && !empty($_POST['message'])) ? $message = $_POST['message'] : $errors[] = 'Veuillez renseigner votre message';

    if(!isset($errors)){
        $send_from = $email;
        $send_to = 'a_little_tiny_world@atelier.com';
        $subject = 'Message de ' . $nom . ' ' . $prenom;
    }
}

try{
    send_mail($send_from,$send_to, $subject, $body);
    $response = array('status' => 'success', 'message' => 'Votre message a bien été envoyé', 'redirect' => $_SERVER['HTTP_REFERER']);
}catch(Exception $e){
    $errors[] = 'Une erreur est survenue lors de l\'envoi du message';
}

if(isset($errors)){
    $response = array('status' => 'error', 'message' => $errors, 'redirect' => $_SERVER['HTTP_REFERER']);
}
echo json_encode($response);
exit;