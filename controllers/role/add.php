<?php
require_once '../../config/db.php';
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_POST['nom']) || empty($_POST['nom'])) {
        $errors = 'Le nom est obligatoire';
    }
    $nom = strip_tags(htmlspecialchars($_POST['nom']));

    try{
        $role = new RoleRepo($pdo);
        $role->create($nom);
        $response = [
            'status' => 'success',
            'message' => 'Le rôle ' . $nom . ' a été ajouté avec succès',
            'redirect' => RACINE_SITE . '../../index.php?page=admin&section=roles'
        ];
    } catch(Exception $e) {
        $errors = 'Erreur lors de l\'ajout du rôle : ' . $e->getMessage();
    }

    if(!empty($errors)) {
        $response = [
            'status' => 'error',
            'message' => $errors
        ];
    }
    //echo json_encode($response);

    if($response['status'] == 'success') {
        header('Location: ' . $response['redirect']);
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    exit;
}