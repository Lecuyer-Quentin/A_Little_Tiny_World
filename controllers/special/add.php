<?php
require_once '../../config/db.php';
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['nom']) || empty($_POST['nom'])) {
        $errors = 'Le nom est obligatoire';
    }
    $nom = strip_tags(htmlspecialchars($_POST['nom']));

    try{
        $special = new SpecialRepo($pdo);
        $special->create($nom);
        $response = [
            'status' => 'success',
            'message' => 'Le spécial ' . $nom . ' a été ajouté avec succès',
            'redirect' => 'index.php?page=admin&section=specials'
        ];
    } catch(PDOException $e) {
        $errors = 'Erreur lors de l\'ajout du spécial : ' . $e->getMessage();
    }

    if(!empty($errors)) {
        $response = [
            'status' => 'error',
            'message' => 'Erreur lors de l\'ajout de la promotion',
        ];
    }
    echo json_encode($response);
    exit;
}