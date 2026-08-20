<?php
/** @var array $location */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Locatie detail</span>
        <h1><?php echo e($location['name']); ?></h1>
        <p><?php echo e($location['description']); ?></p>
    </div>
</section>

<section class="location-detail section">
    <div class="container">
        <div class="location-detail-grid">
            <div>
                <h2>Contactgegevens</h2>
                <ul class="contact-details">
                    <li><span>&#128205;</span> <?php echo e($location['address_street']); ?><br><?php echo e($location['address_postal'] . ' ' . $location['address_city']); ?></li>
                    <li><span>&#9742;</span> <a href="tel:<?php echo tel_link($location['phone']); ?>"><?php echo e($location['phone']); ?></a></li>
                    <li><span>&#9993;</span> <a href="mailto:<?php echo mailto_link($location['email']); ?>"><?php echo e($location['email']); ?></a></li>
                </ul>
                <div class="about-cta" style="margin-top:24px;">
                    <a href="<?php echo $base_url; ?>/booking" class="btn btn-gold">Inschrijven</a>
                    <a href="<?php echo $base_url; ?>/contact" class="btn btn-outline dark">Contact</a>
                </div>
            </div>
            <div class="location-map">
                <?php if ($location['map_embed_url']): ?>
                    <iframe src="<?php echo esc_url($location['map_embed_url']); ?>" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>