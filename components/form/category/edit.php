<?php
global $pdo;

if($_GET['section'] == 'category' && $_GET['action'] == 'edit'){
    if(!isset($_GET['id'])){
        header('Location: index.php?page=admin&section=category');
    }
    $id = $_GET['id'];
    $category = new CategorieRepo($pdo);
    $category = $category->read_one($id);
}

$data_category_edit = get_JSON('config.json', 'form', 'categorie_edit');
$data_category_edit['inputs'][0]['value'] = $category->get_value_of('id');
$data_category_edit['inputs'][1]['placeholder'] = $category->get_value_of('nom');
$data_category_edit['header'][] = [
    "type" => "h2",
    "line" => "Modifier la catégorie : " . "<br /> ". $category->get_value_of('nom')
];
$form_category_edit = new Form($data_category_edit);
echo $form_category_edit->generate_form();