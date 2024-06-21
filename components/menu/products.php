<?php
global $pdo;
    $cat = new CategorieRepo($pdo);
    $categories = $cat->read_all();
?>

<nav class="navbar navbar-light mt-3">
    
    <button class="navbar-toggler mt-1 border-0 shadow-none focus:outline-none focus:ring-0" type="button" data-bs-toggle="collapse" data-bs-target="#products_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span>Voir les catégories</span>
    </button>

    <div class="collapse navbar-collapse" id="products_menu">

        <ul class="navbar-nav d-flex flex-row justify-content-center flex-wrap">
            <?php foreach($categories as $category) : ?>
                <li class="nav-item m-1">
                    <a href="<?php echo RACINE_SITE ?>index.php?page=products&category=<?= $category->get_value_of('id') ?>" class="btn_1">
                        <?= $category->get_value_of('nom') ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>