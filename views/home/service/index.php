<?php
    $data = get_JSON('config.json', 'view', 'services');
    $header = $data['header'];
    $cards = $data['cards'];

function display_service($cards) {
    foreach ($cards as $card) {
        $card = new Card($card);
        echo $card->card_service();
    }
}
?>

<article>
<?php
        foreach($header as $line){
            $type = $line['type'];
            $content = $line['line'];
            echo "<$type>$content</$type>";
        }
    ?>
  
    <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
        <?php display_service($cards); ?>
    </div>
</article>

