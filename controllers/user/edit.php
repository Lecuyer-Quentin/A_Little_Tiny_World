<?php
    require_once '../../config/db.php';
    require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id = isset($_POST['id']) ? $_POST['id'] : $user->get_value_of('id');
    $nom = isset($_POST['nom']) ? $_POST['nom'] : $user->get_value_of('nom');
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : $user->get_value_of('prenom');
    $email = isset($_POST['email']) ? $_POST['email'] : $user->get_value_of('email');
    $numRue = isset($_POST['numRue']) ? $_POST['numRue'] : $user->get_value_of('numRue');
    $nomRue = isset($_POST['nomRue']) ? $_POST['nomRue'] : $user->get_value_of('nomRue');
    $ville = isset($_POST['ville']) ? $_POST['ville'] : $user->get_value_of('ville');
    $codePostal = isset($_POST['codePostal']) ? $_POST['codePostal'] : $user->get_value_of('codePostal');
    $pays = isset($_POST['pays']) ? $_POST['pays'] : $user->get_value_of('pays');
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : $user->get_value_of('telephone');
    $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : $user->get_value_of('avatar');
    $role = isset($_POST['role']) ? $_POST['role'] : $user->get_value_of('role')->get_value_of('id');

    $page = isset($_POST['page']) ? $_POST['page'] : 'home';

    ($page == 'admin') 
        ? $redirect = RACINE_SITE.'../../index.php?page=admin&section=users'
        : $redirect = RACINE_SITE.'../../index.php?page=account&section=dashboard&id=' . $id;


    try{
        $user = new UtilisateurRepo($pdo);

        $avatar = upload_images($avatar, 'images/users/');


        $modify_user = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'numRue' => $numRue,
            'nomRue' => $nomRue,
            'ville' => $ville,
            'codePostal' => $codePostal,
            'pays' => $pays,
            'telephone' => $telephone,
            'avatar' => $avatar,
            'role' => $role,
        ];
        $user->update($id, $modify_user);
        

        $response = [
            'status' => 'success',
            'message' => "L'utilisateur '$nom $prenom' a été mis à jour' avec succès.",
            'redirect' => $redirect,
        ];

    } catch (PDOException $e) {
        $errors = 'Une erreur est survenue';
        //$response = [
        //    'status' => 'error',
        //    'message' => 'Une erreur est survenue lors de la mise à jour de l\'utilisateur.',
        //];
    }

    //echo json_encode($response);
    if($response['status'] == 'success') {
        header('Location: ' . $response['redirect']);
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    exit;
}