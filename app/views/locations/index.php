<?php
/** @var array $locations */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Locaties</span>
        <h1>Vind een locatie bij u in de buurt</h1>
        <p>ZOEM Kinderopvang is gevestigd in Vorden, naast Basisschool De Kraanvogel.</p>
    </div>
</section>

<section class="locations section">
    <div class="container">
        <?php if (empty($locations)): ?>
            <p class="empty-note">Er zijn momenteel geen locaties gevonden.</p>
        <?php else: ?>
            <div class="locations-list">
                <?php foreach ($locations as $loc): ?>
                    <article class="location-card reveal">
                        <div class="location-content">
                            <span class="kicker">Locatie</span>
                            <h2><?php echo e($loc['name']); ?></h2>
                            <p class="location-address">
                                &#128205; <?php echo e($loc['address_street']); ?><br>
                                <?php echo e($loc['address_postal'] . ' ' . $loc['address_city']); ?>
                            </p>
                            <p><?php echo e($loc['description']); ?></p>
                            <p class="location-contact">
                                <a href="tel:<?php echo tel_link($loc['phone']); ?>">&#9742; <?php echo e($loc['phone']); ?></a>
                                &middot;
                                <a href="mailto:<?php echo mailto_link($loc['email']); ?>">&#9993; <?php echo e($loc['email']); ?></a>
                            </p>
                            <a href="<?php echo $base_url; ?>/location/<?php echo e($loc['slug']); ?>" class="btn btn-outline">Bekijk locatie</a>
                        </div>
                        <?php if ($loc['map_embed_url']): ?>
                            <div class="location-map">
                                <iframe src="<?php echo esc_url($loc['map_embed_url']); ?>" width="100%" height="280" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>