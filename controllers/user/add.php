<?php 
require_once '../../config/db.php';
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_POST['nom']) || empty($_POST['nom'])
    || !isset($_POST['prenom']) || empty($_POST['prenom'])
    || !isset($_POST['email']) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    || !isset($_POST['password']) || empty($_POST['password'])
    || !isset($_POST['password_confirm']) || empty($_POST['password_confirm'])
    || !isset($_POST['role']) || empty($_POST['role'])
    || !isset($_FILES['avatar'])
    ) {
        $errors = 'Veuillez remplir tous les champs';
    }

    $nom = strip_tags(htmlspecialchars($_POST['nom']));
    $prenom = strip_tags(htmlspecialchars($_POST['prenom']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    $password = strip_tags(htmlspecialchars($_POST['password']));
    $password_confirm = strip_tags(htmlspecialchars($_POST['password_confirm']));
    $role = intval(strip_tags(htmlspecialchars($_POST['role'])));
    $numRue = isset($_POST['numRue']) ? strip_tags(htmlspecialchars($_POST['numRue'])) : '';
    $nomRue = isset($_POST['nomRue']) ? strip_tags(htmlspecialchars($_POST['nomRue'])) : '';
    $ville = isset($_POST['ville']) ? strip_tags(htmlspecialchars($_POST['ville'])) : '';
    $codePostal = isset($_POST['codePostal']) ? strip_tags(htmlspecialchars($_POST['codePostal'])) : '';
    $pays = isset($_POST['pays']) ? strip_tags(htmlspecialchars($_POST['pays'])) : '';
    $telephone = isset($_POST['telephone']) ? strip_tags(htmlspecialchars($_POST['telephone'])) : '';
    $avatar = $_FILES['avatar'];

    if($password !== $password_confirm) {
        $errors = 'Les mots de passe ne correspondent pas';
    }

    try {
        $user = new UtilisateurRepo($pdo);
        $rolesRepo = new RoleRepo($pdo);
        $role = $rolesRepo->read_one($role);

        $avatar = upload_images($avatar, 'images/users/');


        $user->create([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => $password_confirm,
            'role' => $role,
            'avatar' => $avatar,
            'isActif' => 0,
            'token' => uniqid(),
            'numRue' => $numRue,
            'nomRue' => $nomRue,
            'ville' => $ville,
            'codePostal' => $codePostal,
            'pays' => $pays,
            'telephone' => $telephone,
        ]);

        //$response = array(
        //    'status' => 'success',
        //    'message' => 'Utilisateur ' . $nom . ' ' . $prenom . ' ajouté avec succès',
        //    'redirect' => 'index.php?page=admin&section=users',
        //);
      
    } catch (Exception $e) {
        $msg = 'Erreur lors de l\'ajout de l\'utilisateur : ' . $e->getMessage();
        $errors = $msg;
    }

    //if(!empty($errors)) {
    //    $response = array(
    //        'status' => 'error',
    //        'message' => $errors,
    //    );
    //}

    //echo json_encode($response);

    header('Location: ../../index.php?page=admin&section=users');
    exit;
}
