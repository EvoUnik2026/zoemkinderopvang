<?php
/** @var array $news */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Nieuws &amp; agenda</span>
        <h1>De laatste nieuwtjes</h1>
        <p>Nieuws, activiteiten and atagend points from ZOEM Kinderopvang.</p>
    </div>
</section>

<section class="news section">
    <div class="container">
        <?php if (empty($news)): ?>
            <p class="empty-note">Er zijn momenteel geen nieuwsitems.</p>
        <?php else: ?>
            <div class="news-grid">
                <?php foreach ($news as $n): ?>
                    <article class="news-card reveal">
                        <time><?php echo e(format_date($n['published_at'] ?? '')); ?></time>
                        <?php if ($n['image_url']): ?>
                            <img src="<?php echo esc_url($n['image_url']); ?>" alt="<?php echo e($n['title']); ?>" loading="lazy">
                        <?php endif; ?>
                        <h3><?php echo e($n['title']); ?></h3>
                        <p><?php echo e($n['excerpt']); ?></p>
                        <a href="<?php echo $base_url; ?>/news/<?php echo e($n['slug']); ?>" class="read-more">Lees meer &rarr;</a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>