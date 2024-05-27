<?php
    $data = get_JSON('config.json', 'view', 'footer');
    $data_footer = array(
        $data['navigation'],
        $data['legal']
    );
    $data_social = $data['social'];
?>

<footer class="d-flex flex-column">
    <div class="d-flex flex-column justify-content-center align-items-center text-center my-5">
        <h2>Retrouvez-nous sur les réseaux sociaux</h2>
        <div class="d-flex flex-row justify-content-center align-items-center">
            <?php
                foreach($data_social['items'] as $item) {
                    $list = "<a href='$item[value]' target='_blank' rel='noopener noreferrer' class='social-link'>
                                <img src='$item[icon]' alt='$item[label]'>
                            </a>";
                    echo $list;
                }
            ?>
        </div>
        <span>
            Icon made by <a href=" icons8.com " title="Icons8" target="_blank" rel="noopener noreferrer"> Icons8 </a>
        </span>
    </div>

    <div class="d-flex flex-row justify-content-around">
        <?php
            foreach($data_footer as $item) {
                $list = "<div class='d-flex flex-column'>";
                    $list .= "<ul>";
                        $list .= "<h3>$item[title]</h3>";

                        foreach($item['items'] as $link) {
                            $list .= "<li><a href='$link[value]'>$link[label]</a></li>";
                        }
                    $list .= "</ul>";
                $list .= "</div>";
                echo $list;
            }
        ?>
    </div>

    <div class="text-center mt-3">
        <p>&copy; 2024 - All rights reserved</p>
    </div>
</footer>