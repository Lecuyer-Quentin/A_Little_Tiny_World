<?php
    $data = get_JSON('config.json', 'menu', 'navigation');
    $items = $data['items'];
?>

<span class='d-flex justify-content-end'>
    <?php require_once 'components/menu/user.php';?>
    <?php require_once 'components/menu/cart.php';?>
    
    <button class="navbar-toggler shadow-none focus:outline-none focus:ring-0" style="border: none; margin-left: 1rem;"
     type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</span>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav flex-row justify-content-end">
        <?php foreach($items as $item): ?>
            <li class="nav-item mx-2">
                <a class="nav-link" href="<?php echo RACINE_SITE . $item['value']; ?>"><?php echo $item['label']; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>