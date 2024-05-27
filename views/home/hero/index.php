<?php require 'views/home/produits/index.php'; ?>

<article class="card mb-3 text-white position-relative">
    <img src="assets/images/champs-de-lavande.jpg" class="card-img img-fluid" style="max-height: 400px; object-fit: cover;" alt="Champs de lavande">
    <div class="card-img-overlay">
        <h1 class="card-title position-absolute top-0 start-0 p-3">
            Bienvenue chez nous
        </h1>
        <div class="d-none d-lg-flex row w-50 position-absolute top-50 end-0 translate-middle-y gap-3">
            <?php echo $product_cards; ?>
        </div> 
        <p class="card-text position-absolute bottom-0 end-0 px-3 py-2 bg-dark bg-opacity-75">
            Votre boutique en ligne pour tous vos besoins en matière de maison, de famille et de vous-même.
        </p>
    </div>
</article>

<article class="d-lg-none">
        <h2>Nos Produits</h2>
            <p>Parcourez notre collection et trouvez tout ce dont vous avez besoin pour votre maison, votre famille et vous-même.</p>
        <div class="row mt-4 mb-4 text-center justify-content-center align-items-center gap-3">
            <?php echo $product_cards; ?>
        </div>          
</article>