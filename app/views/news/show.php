<?php
/** @var array $item */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Nieuws</span>
        <h1><?php echo e($item['title']); ?></h1>
        <time><?php echo e(format_date($item['published_at'] ?? '')); ?></time>
    </div>
</section>

<section class="news-detail section">
    <div class="container" style="max-width:820px;">
        <?php if ($item['image_url']): ?>
            <img src="<?php echo esc_url($item['image_url']); ?>" alt="<?php echo e($item['title']); ?>" class="news-hero-img">
        <?php endif; ?>
        <div class="news-body">
            <p><?php echo nl2br(e($item['content'])); ?></p>
        </div>
        <div class="center" style="margin-top:30px;">
            <a href="<?php echo $base_url; ?>/news" class="btn btn-outline">Terug naar nieuws</a>
        </div>
    </div>
</section>