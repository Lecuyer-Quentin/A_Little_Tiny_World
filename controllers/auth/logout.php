<?php
require_once '../../page.inc.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    try {
        session_start();
        session_destroy();

        $response = array(
            'status' => 'success',
            'message' => 'Vous êtes déconnecté',
            'redirect' => RACINE_SITE . 'index.php?page=home'
        );
    } catch (PDOException $e) {
        $response = array(
            'status' => 'error',
            'message' => 'Erreur lors de la déconnexion',
        );
    }
    echo json_encode($response);
    exit;
}