<?php 
require_once 'components/favorite/index.php';
if(isset($_SESSION['favorite']) && !empty($_SESSION['favorite'])){
    $favorite = $_SESSION['favorite'];
} else {
    $favorite = [];
}

if(isset($_COOKIE['favorite'])) {
    $fav_cookie = json_decode($_COOKIE['favorite'], true);
    if(is_array($fav_cookie)){
        $favorite = array_merge($favorite, $fav_cookie);
    }
}

$favorite = array_unique($favorite);

?>


<article>
        <?php 
            echo render_favorite($favorite);
        ?>
</article>