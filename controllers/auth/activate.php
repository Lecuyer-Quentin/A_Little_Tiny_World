<?php
require_once '../../config/db.php';
require_once '../../page.inc.php';
global $pdo;

if(isset($_GET['token']) && !empty($_GET['token'])){
    $token = $_GET['token'];
    $user = new UtilisateurRepo($pdo);
    $user = $user->activate($token);
    if($user){
        $response = array(
            //'status' => 'success',
            //'message' => 'Votre compte a bien été activé, vous pouvez vous connecter',
            'redirect' =>  RACINE_SITE . 'index.php?page=home',
        );
    }else{
        $response = array(
            //'status' => 'error',
            //'message' => 'Une erreur est survenue lors de l\'activation de votre compte',
            'redirect' => RACINE_SITE . 'index.php?page=home',
        );
    }
}else{
    $response = array(
        //'status' => 'error',
        //'message' => 'Token invalide',
        'redirect' => RACINE_SITE . 'index.php?page=home',
    );
}

header('Location: '.$response['redirect']);

//echo json_encode($response);







