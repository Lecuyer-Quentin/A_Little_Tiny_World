<?php
require_once 'page.inc.php';
$user_menu_data = get_JSON('config.json', 'menu', 'account');
$user_menu = $user_menu_data['items'];
$user_session = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$id = isset($user_session) ? $user_session['id'] : null;
$user = $id ? new UtilisateurRepo($pdo) : null;
$user = $user ? $user->read_one($id) : null;
$user_role = $user ? $user->get_value_of('role')->get_value_of('id') : RoleEnum::Guest->value;


function render_menu($menu) {
    global $id;
    $html = '';
    foreach($menu as $item) {
        $html .= '<li>
                    <a class="dropdown-item menu_link" href="' . $item['value'] .'&id='. $id . '"> 
                        <img src="' . $item['icon'] . '" alt="' . $item['label'] . '" class="menu_link_icon">
                        <span>' . $item['label'] . '</span>
                    </a>
                </li>';
    }
    return $html;
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <?php if($user): ?>
            <span class="d-md-block mx-2">Bonjour <?php echo $user->__toString(); ?></span>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Mon compte
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    
                    <?php echo render_menu($user_menu); ?>

                    <?php if($user_role == RoleEnum::Admin->value || $user_role == RoleEnum::Dev->value): ?>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item menu_link" href="index.php?page=admin&section=dashboard">
                            <img src="assets/svg/admin.svg" alt="Admin" class="menu_link_icon">
                            <span>Admin</span>
                        </a></li>
                    <?php endif; ?>
                    <li class="dropdown-divider"></li>
                    <li>
                        <? require_once 'components/form/auth/logout.php'; ?>
                    </li>

                </ul>
            </div>
        <?php elseif(!$user): ?>
            <? require_once 'components/form/auth/login.php'; ?>
        <?php endif; ?>
    </div>
</nav>
