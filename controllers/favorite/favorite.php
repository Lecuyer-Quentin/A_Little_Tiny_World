<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_POST['favorite']) || empty($_POST['favorite'])) {
        $errors[] = 'Une erreur est survenue lors de l\'ajout du produit aux favoris';
    }

    if(!isset($_POST['id']) || empty($_POST['id']) && is_numeric($_POST['id'])) {
        $errors[] = 'Une erreur est survenue lors de l\'ajout du produit aux favoris';
    }

    $fav_value = $_POST['favorite'];
    $productId = $_POST['id'];

    if (!isset($_SESSION['favorite'])) {
        $_SESSION['favorite'] = [];
    }

    switch ($fav_value) {
        case 'add':
            if(isset($_SESSION['favorite'])) {
                if (!in_array($productId, $_SESSION['favorite'])) {
                    $_SESSION['favorite'][] = $productId;
                }
            }
            $cookieData = isset($_COOKIE['favorite']) ? json_decode($_COOKIE['favorite'], true) : [];
            if (!in_array($productId, $cookieData)) {
                $cookieData[] = $productId;
            }
            setcookie('favorite', json_encode($cookieData), time() + 3600, '/');

            $response = [
                'status' => 'success',
                'message' => 'Le produit a été ajouté aux favoris',
                'redirect' => $_SERVER['HTTP_REFERER']
            ];
            break;
        case 'remove':
            if(isset($_SESSION['favorite'])) {
                if (($key = array_search($productId, $_SESSION['favorite'])) !== false) {
                    unset($_SESSION['favorite'][$key]);
                }
            }
            if(isset($_COOKIE['favorite'])) {
                $cookieData = isset($_COOKIE['favorite']) ? json_decode($_COOKIE['favorite'], true) : [];

                if (in_array($productId, $cookieData)) {
                    $key = array_search($productId, $cookieData);
                    unset($cookieData[$key]);
                    setcookie('favorite', json_encode($cookieData), time() + 3600, '/');
                }
            }
            $response = [
                'status' => 'success',
                'message' => 'Le produit a été retiré des favoris',
                'redirect' => $_SERVER['HTTP_REFERER']
            ];
            break;
        default:
            break;
    }

    if(!empty($errors)) {
        $response = [
            'status' => 'error',
            'message' => $errors,
            'redirect' => $_SERVER['HTTP_REFERER']
        ];
    }

    echo json_encode($response);
    exit;
} 
