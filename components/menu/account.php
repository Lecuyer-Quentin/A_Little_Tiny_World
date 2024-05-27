<?php
    $data = get_JSON('config.json', 'menu', 'account');
    $items = $data['items'];
    $id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : null;
?>

<nav class="navbar navbar-expand-md navbar-light bg-light">

    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#account_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="account_nav">
        <ul class="navbar-nav flex-row justify-content-center flex-wrap">
            <?php foreach($items as $item): ?>
                <li class="nav-item mx-1">
                    <a href="<?php echo $item['value'] . '&id=' . $id; ?>" class="nav-link">
                        <strong><?php echo $item['label']; ?></strong>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>