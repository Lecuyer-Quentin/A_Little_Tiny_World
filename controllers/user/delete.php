<?php
require_once '../../config/db.php';
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_POST['id'])){
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    $id = $_POST['id'];

    $logout = isset($_POST['logout']) ? $_POST['logout'] : null;


    try{
        $user = new UtilisateurRepo($pdo);
        $user->delete($id);
        if($logout){
            session_start();
            session_unset();
            session_destroy();
            header('Location: '.RACINE_SITE.'index.php');
        }
        //$response = [
        //    'status' => 'success',
        //    'message' => 'L\'utilisateur a été supprimé avec succès.',
        //    'redirect' => $_SERVER['HTTP_REFERER']
        //];
    } catch (PDOException $e) {
        $errors = 'Une erreur est survenue';
    }
    
    //echo json_encode($response);
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}