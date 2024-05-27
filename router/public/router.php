<?php
require_once 'page.inc.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$page =  basename($page);
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$role = $user ? $user['role'] : RoleEnum::Guest->value;

$allowedPages = ['home', 'products', 'product', 'contact', 'denied', '404'];

($role == RoleEnum::Admin->value) || ($role == RoleEnum::Dev->value)
        ? array_push($allowedPages,  'admin', 'account')
        : null;

($role == RoleEnum::User->value) ? array_push($allowedPages, 'account') : null;

($role == RoleEnum::Guest->value) ? null : null;


if (!in_array($page, $allowedPages)) {
    $page = 'denied';
}

if (!file_exists('views/' . $page . '/index.php')) {
    $page = '404';
}

function renderMain($page) {
    global $role;
    $main = '<main class="container container-fluid container-' . $page . '">';
        $main .= include_once('views/' . $page . '/index.php');
    $main .= '</main>';
    return $main;
}

renderMain($page);
