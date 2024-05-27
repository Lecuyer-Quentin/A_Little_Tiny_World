<?php
    $data_register_form = get_JSON('config.json', 'form', 'register');
    $form_register = new Form($data_register_form);
    $form_register = $form_register->generate_form();
    $modal_trigger_login = "<span class='d-block text-center'> Deja inscrit ?<a class='btn btn-link' data-bs-toggle='modal' data-bs-target='#login_modal'> Connexion </a></span>";

    $data_register_modal = [
        'id' => 'register_modal',
        'class' => 'modal-dialog-centered',
        'title' => 'Inscription',
        'body' => $form_register,
        'footer' => $modal_trigger_login,
    ];

    $modal_register = new Modal($data_register_modal);
    $modal_register->modal_trigger();