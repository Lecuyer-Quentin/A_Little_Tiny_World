<?php
require_once '../../config/db.php';
require_once '../../page.inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(
        !isset($_POST['nom']) || empty($_POST['nom']) 
        || !isset($_POST['prenom']) || empty($_POST['prenom']) 
        || !isset($_POST['email']) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) 
        || !isset($_POST['password']) || empty($_POST['password']) 
        || !isset($_POST['password_confirm']) || empty($_POST['password_confirm'])
        || !isset($_POST['role']) || empty($_POST['role'] || !is_numeric($_POST['role']))
    ){
        $errors = 'Veuillez remplir tous les champs';
    }

    if($_POST['password'] !== $_POST['password_confirm']){
        $errors = 'Les mots de passe ne correspondent pas';
    }

    $nom = strip_tags(htmlspecialchars($_POST['nom']));
    $prenom = strip_tags(htmlspecialchars($_POST['prenom']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    $mot_de_passe = strip_tags(htmlspecialchars($_POST['password']));
    $role = intval(strip_tags(htmlspecialchars($_POST['role'])));

    try {
        $user = new UtilisateurRepo($pdo);
        $rolesRepo = new RoleRepo($pdo);
        $role = $rolesRepo->read_one($role);
        $data = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => $mot_de_passe,
            'role' => $role,
            'isActif' => 0,
            'token' => bin2hex(random_bytes(32)),
        );
        $new_user = $user->register($data);

        $send_to = $email;
        $send_from = 'a_little_tiny_world@atelier.com';
        $subject = 'Activation de votre compte';
        $body = 'Bonjour ' . $prenom . ',<br><br>';
        $body .= 'Veuillez cliquer sur le lien suivant pour activer votre compte : <a href="'.URL_SITE .'controllers/auth/activate.php?token=' . $data['token'] . '">Activer mon compte</a>';
        $body .= '<br><br>Cordialement,<br>L\'équipe A Little Tiny World';
        send_mail($send_from, $send_to, $subject, $body);

        $response = array(
            'status' => 'success',
            'message' => 'Votre compte a bien été créé, veuillez vérifier votre boîte mail pour activer votre compte',
            'redirect' => $_SERVER['HTTP_REFERER'],
        );
        
    } catch (PDOException $e) {
        $mgs = 'Erreur lors de l\'inscription';
        $errors = $msg;
    }

    if(!empty($errors)){
        $response = array(
            'status' => 'error',
            'message' => $errors,
        );
    }

    echo json_encode($response);
    exit;
}