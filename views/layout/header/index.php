<?php
    $data = get_JSON('config.json', 'view', 'header');
    $nav_items = get_JSON('config.json', 'menu', 'navigation');

    function logo() {
        global $data;
        if(isset($data['logo'])) {
            $logo = "<div class='d-none d-md-block'>";
                $logo .= "<a href='index.php'>";
                    $logo .= "<img src='$data[logo]' alt='Logo' width='200' height='50'>";
                $logo .= "</a>";
            $logo .= "</div>";
            return $logo;
        } else {
            return null;
        }
    }
?>

<header class="navbar fixed-top bg-light shadow-sm
                d-flex justify-content-end align-items-center 
                justify-content-md-between">
    <?php echo logo();?>
        <div class="d-none d-xl-flex">
            <?php require_once 'components/search/searchBar.php';?>
        </div>
    <?php require_once 'components/menu/navigation.php';?>  
</header>