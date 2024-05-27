<?php
$data = get_JSON('config.json', 'view', 'dashboard');
$header = $data['header'];
$cards = $data['cards'];
?>

<article class="container container-fluid mt-2">
<?php
        foreach($header as $line){
            $type = $line['type'];
            $content = $line['line'];
            echo "<$type>$content</$type>";
        }
    ?>

    <div class="mt-5 my-5 d-flex justify-content-center flex-wrap">
        <?php
            foreach($cards as $c){  
                $c = new Card($c);
                echo $c->card_dash();                    
            }
        ?>
    </div>
</article>