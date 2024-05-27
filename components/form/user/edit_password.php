<?php
global $pdo;
$user = new UtilisateurRepo($pdo);
$user = $user->read_one($_GET['id']);

$form = new Form([
    'header' => [
        ['type' => 'h3', 'line' => 'Modifier votre mot de passe'],
    ],
    'inputs' => [
        ['type' => 'password', 'name' => 'password', 'placeholder' => 'Mot de passe', 'required' => true],
        ['type' => 'password', 'name' => 'password_confirm', 'placeholder' => 'Confirmer le mot de passe', 'required' => true],
        ['type' => 'hidden', 'name' => 'id', 'value' => $user->get_value_of('id'), 'required' => true],
    ],
    'id' => 'edit_password_form',
    'action' => 'controllers/user/edit_password.php',
    'method' => 'POST',
]);
echo $form->generate_form();