<?php 
require_once '../../config/db.php';
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_POST['id']) || empty($_POST['id'])){
        $errors = 'Une erreur est survenue';
    }

    if(!isset($_POST['password']) || empty($_POST['password'])
    || !isset($_POST['password_confirm']) || empty($_POST['password_confirm'])
    ) {
        $errors = 'Veuillez remplir tous les champs';
    }

    $password = strip_tags(htmlspecialchars($_POST['password']));
    $password_confirm = strip_tags(htmlspecialchars($_POST['password_confirm']));
    $id = intval(strip_tags(htmlspecialchars($_POST['id'])));

    if($password !== $password_confirm) {
        $errors = 'Les mots de passe ne correspondent pas';
    }

    try {
        $user = new UtilisateurRepo($pdo);

        $user->update_password($id, $password_confirm);
        $response = [
            'status' => 'success',
            'message' => 'Mot de passe modifié avec succès',
            'redirect' => RACINE_SITE.'index.php?page=account&section=dashboard&id=' . $id ,
        ];
        
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => 'Une erreur est survenue',
        ];
    }

    echo json_encode($response);
    exit;


}


    