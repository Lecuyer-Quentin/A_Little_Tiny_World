<?php
global $pdo;
require_once 'components/favorite/index.php';
require_once 'components/order/index.php';


if(isset($_SESSION['favorite']) && !empty($_SESSION['favorite'])){
    $favorite = $_SESSION['favorite'];
} else {
    $favorite = [];
}

if(isset($_COOKIE['favorite'])) {
    $fav_cookie = json_decode($_COOKIE['favorite'], true);
    if(is_array($fav_cookie)){
        $favorite = array_merge($favorite, $fav_cookie);
    }
}

$favorite = array_unique($favorite);

    if(!$_GET['id']){
        header('Location: index.php');
        exit;
    }

    $check_user = $_GET['id'] == $_SESSION['user']['id'] ? true : false;

    if(!$check_user) {
        echo "<div class='alert alert-danger'>Vous n'êtes pas autorisé à accéder à cette page</div>";
    } else {
        $id = $_GET['id'];
        $user = new UtilisateurRepo($pdo);
        $user = $user->read_one($id);
        echo render_dashboard($user, $favorite);
    }

    function render_dashboard($user, $favorite) {
        $html = "<article class='container container d-flex flex-column align-items-start justify-content-start min-vh-100 my-4'>";
        $html .= "<h2>Tableau de bord Utilisateur</h2>";
        $html .= "<p>Bienvenue sur votre tableau de bord, " . $user->get_value_of('nom') . " " . $user->get_value_of('prenom') . "!</p>";
        $html .= render_user_info($user);
        $html .= render_favorite($favorite);
        $html .= render_order();
        $html .= "</article>";
        return $html;
    }


    function render_user_info($user) {
        $id = $user->get_value_of('id');
        $nom = $user->get_value_of('nom');
        $prenom = $user->get_value_of('prenom');
        $user_name = $nom . ' ' . $prenom;
        $email = $user->get_value_of('email');
        $role = $user->get_value_of('role')->get_value_of('nom');
        $numRue = $user->get_value_of('numRue');
        $nomRue = $user->get_value_of('nomRue');
        $codePostal = $user->get_value_of('codePostal');
        $ville = $user->get_value_of('ville');
        $pays = $user->get_value_of('pays');
        $avatar = $user->get_value_of('avatar');
        $date = $user->get_value_of('date_inscription');
        $telephone = $user->get_value_of('telephone');

        if(!empty($numRue) && !empty($nomRue) && !empty($ville) && !empty($codePostal)) {
            $address = $numRue . ', ' . $nomRue . ', ' . $ville . ', ' . $codePostal;
        } elseif(empty($numRue) || empty($nomRue) || empty($ville) || empty($codePostal)) {
            $address = 'Adresse incomplète.';
        } else {
            $address = 'Pas d\'adresse renseignée.';
        }
        
        if($pays == '') {
            $pays = 'Pas de pays renseigné.';
        }
        //! Changer l'avatar par défaut
        if(!isset($avatar)) {
            $avatar = 'assets/img/user.png';
        }
        if($telephone == '') {
            $telephone = 'Pas de numéro de téléphone renseigné.';
        }

        //$html = "<article class='container container d-flex flex-column align-items-start justify-content-start'>";
        //$html .= "<h2>Tableau de bord Utilisateur</h2>";
        //$html .= "<p>Bienvenue sur votre tableau de bord, " . $user_name . "!</p>";
        $html = "<aside class='card d-flex w-100 flex-column justify-content-between align-items-center p-3'>";
            $html .= "<div class='d-flex w-100 flex-row justify-content-between align-items-center'>";
                $html .= "<div class='d-flex flex-row align-items-center position-relative'>";
                    $html .= "<img src='" . $avatar . "' alt='User' width='100' height='100' class='rounded-circle p-1 border border-1 border-dark bg-info'>";
                    $html .= "<span class='position-absolute bottom-0 start-0 cursor-pointer' style='padding: 0.3rem; background-color: #f8f9fa; border-radius: 50%;'>";
                        $html .= "<a type='button' data-bs-toggle='collapse' data-bs-target='#account_collapse' aria-expanded='false' aria-controls='profile_collapse'>";
                            $html .= "<img src='assets/svg/chevron_down.svg' alt='arrow' width='20' height='20'>";
                        $html .= "</a>";
                    $html .= "</span>";
                $html .= "</div>";
                $html .= "<div class='d-flex flex-column align-items-end'>";
                    $html .= "<h2>" . $user_name . "</h2>";
                    $html .= "<p>" . $email . "</p>";
                    $html .= "<p>" . $role . "</p>";
                $html .= "</div>";
            $html .= "</div>";
            $html .= "<div class='collapse pt-3' id='account_collapse'>";
                $html .= "<div class='card card-header'>";
                    $html .= "<h5>Informations Personnelles</h5>";
                    $html .= "<a href='index.php?page=account&section=settings&id=" . $id . "' class='btn btn-primary'>Modifier</a>";
                $html .= "</div>";
            $html .= "<div class='card card-body'>";
                $html .= "<p><strong>Adresse:</strong><br />" . $address . "</p>";
                $html .= "<p><strong>Pays:</strong><br />" . $pays . "</p>";
                $html .= "<p><strong>Téléphone:</strong><br />" . $telephone . "</p>";
                $html .= "<p></p><strong>Date d'inscription:</strong><br />" . $date . "</p>";
            $html .= "</div>";
            $html .= "</div>";
        $html .= "</aside>";
        return $html;
    }


