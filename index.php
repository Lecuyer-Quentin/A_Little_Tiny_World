<?php 
session_start();
require_once 'page.inc.php';
require_once 'config/db.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$metaLogo = get_JSON('config.json', 'image', 'metaLogo');
?>
<!DOCTYPE html>
<html lang = "fr">
<head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-commerce">
    <meta name="keywords" content="E-commerce, NFA021">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days">
    <meta name="language" content="fr">
    <meta name="Content-Type" content="text/html">
    <meta name="theme-color" content="#000000">

    <title><?php echo ucfirst($page); ?></title>
    <?php foreach($metaLogo as $item): ?>
        <?php if($item['name'] == $page): ?>
            <link rel = "icon" href = "<?php echo $item['src']; ?>">
        <?php endif; ?>
    <?php endforeach; ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href = "<?php echo RACINE_SITE; ?>assets/custom.css">
    <link rel="manifest" href="manifest.webmanifest">

</head>

    <body class="container container-fluid min-vh-100 min-vw-100 overflow-y-auto overflow-x-hidden
                    d-flex flex-column justify-content-between ">
                    
        <?php 
            require_once 'views/layout/header/index.php';

            require_once 'router/public/router.php';

            require_once 'components/alert/index.php';

            require_once 'components/search/searchResult.php';
        
           if(isset($modal_login)){
               echo $modal_login->modal_content();
           }

           if(isset($modal_register)){
               echo $modal_register->modal_content();
           }

            if(isset($cart)){
                echo $cart->off_canvas();
            }

            require_once 'views/layout/footer/index.php';
        ?>

        <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <script src = "assets/ajax/script.js"></script>
        <script src = "assets/ajax/search.js"></script>
       
    </body>
    
</html>
