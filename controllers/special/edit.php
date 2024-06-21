<?php
require_once '../../config/db.php';
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['id']) || empty($_POST['id']) || !is_numeric($_POST['id'])) {
        $errors = 'id is required';
    }
    if(!isset($_POST['nom']) || empty($_POST['nom'])) {
        $errors = 'nom is required';
    }

    $id = intval(strip_tags(htmlspecialchars($_POST['id'])));
    $nom = strip_tags(htmlspecialchars($_POST['nom']));

    try {
        $special = new SpecialRepo($pdo);
        $special = $special->update($id, $nom);
        $response = [
            'status' => 'success',
            'message' => 'Le spécial ' . $nom . ' a été modifié avec succès',
            'redirect' => RACINE_SITE.'index.php?page=admin&section=specials'
        ];
    } catch (Exception $e) {
        $errors = $e->getMessage();
    }

    if(!empty($error)) {
        $response = [
            'status' => 'error',
            'message' => 'Error',
        ];
    }

    echo json_encode($response);
    exit;
}