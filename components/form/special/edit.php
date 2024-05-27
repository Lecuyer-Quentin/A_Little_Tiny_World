<?php
global $pdo;
 if($_GET['section'] == 'specials' && $_GET['action'] == 'edit'){
    $id = $_GET['id'];
    $special = new SpecialRepo($pdo);
    $special = $special->read_one($id);
}

$data_special_edit = get_JSON('config.json', 'form', 'special_edit');
$data_special_edit['inputs'][0]['value'] = $special->get_value_of('id');
$form_special_edit = new Form($data_special_edit);
echo $form_special_edit->generate_form();