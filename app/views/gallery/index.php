<?php
/** @var array $photos */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Impressies</span>
        <h1>Een dag vol kinderlach</h1>
        <p>Impressies van spelen, ontdekken en samenwerken bij ZOEM.</p>
    </div>
</section>

<section class="gallery section">
    <div class="container">
        <?php if (empty($photos)): ?>
            <p class="empty-note">Er zijn momenteel geen foto&rsquo;s beschikbaar.</p>
        <?php else: ?>
            <div class="photo-grid full">
                <?php foreach ($photos as $ph): ?>
                    <figure class="photo-item">
                        <img src="<?php echo esc_url($ph['image_url']); ?>" alt="<?php echo e($ph['caption']); ?>" loading="lazy">
                        <figcaption><?php echo e($ph['caption']); ?></figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>