<?php
require_once 'register.php';
    $data_login_form = get_JSON('config.json', 'form', 'login');
    $form_login = new Form($data_login_form);
    $modal_trigger_register = "<span class='d-block text-center'>Pas encore de compte ? <a type='button' class='btn btn-link' data-bs-toggle='modal' data-bs-target='#register_modal'> S'inscrire </a></span>";

   $data_login_modal = [
       'id' => 'login_modal',
       'class' => 'modal-dialog-centered',
       'title' => 'Connexion',
       'body' => $form_login->generate_form(),
        'footer' => $modal_trigger_register,
   ];

$modal_login = new Modal($data_login_modal);
echo $modal_login->modal_trigger();