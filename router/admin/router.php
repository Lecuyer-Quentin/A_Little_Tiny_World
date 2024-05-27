<?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'admin';
    $page =  basename($page);
    $section = isset($_GET['section']) ? $_GET['section'] : '';
    $section =  basename($section);
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $action =  basename($action);

        if($action){
            include_once('views/' . $page . '/' . $section . '/' . $action . '.php');
        }else{
            include_once('views/' . $page . '/' . $section . '/index.php');
        }