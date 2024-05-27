<?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'account';
    $page =  basename($page);
    $section = isset($_GET['section']) ? $_GET['section'] : '';
    $section =  basename($section);

    include_once('views/' . $page . '/' . $section . '/index.php');