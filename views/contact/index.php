<?php
    $contact_form_data = get_JSON('config.json', 'form', 'contact');
    $contact_form = new Form($contact_form_data);
    $contact_data = get_JSON('config.json', 'view', 'contact');
    $contact_header = $contact_data['header'];
    $contact_info = $contact_data['info'];
    $iframe_src = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.0000000000005!2d5.377853870391846!3d43.48868942260742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9c7f1b1b1b1b1%3A0x12c9c7f1b1b1b1b1!2sMarseille%20Provence%20Airport!5e0!3m2!1sen!2sfr!4v1623686820001!5m2!1sen!2sfr';

    function render_contact_info($contact_info) {
        $html = '';
        foreach ($contact_info as $value) {
            $type = $value['type'];
            $line = $value['line'];
            $name = isset($value['name']) ? $value['name']. ":" : '';
            $html .= "<$type><strong>$name</strong> $line</$type>";
        }
        return $html;
    }

    function render_contact_header($contact_header) {
        $html = '';
        foreach ($contact_header as $value) {
            $type = $value['type'];
            $line = $value['line'];
            $html .= "<$type>$line</$type>";
        }
        return $html;
    }

?>

<section class="container container-fluid">
    <article class="container">
        <?= render_contact_header($contact_header) ?>          
    </article>
    <article class="d-xl-flex justify-xl-content-around">
        
        <?= $contact_form->generate_form() ?>

        <aside class="d-flex flex-column justify-content-around w-100">
            <hr class="my-4">

            <div class="p-2 pb-1 bg-dark rounded-4">
                <iframe src="<?= $iframe_src ?>" width="100%" height="300" style="border:2;border-radius: 10px; border-color: #000;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <hr class="my-4">

            <div class="p-2 bg-dark rounded-3 text-white">
                <?= render_contact_info($contact_info) ?>
            </div>
            <hr class="my-4">

        </aside>
    </article>
    

   
</section>

