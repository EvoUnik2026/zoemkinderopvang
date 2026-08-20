<?php
/** @var array $services */
/** @var array $reviews */
/** @var array $photos */
/** @var array $pedagogy */
/** @var float $avg_rating */
/** @var int $review_count */
/** @var int $years */
?>

<!-- HERO -->
<section class="hero" id="home">
    <div class="hero-bg" aria-hidden="true"><div class="hero-orbs"></div></div>
    <div class="container hero-inner">
        <div class="hero-content">
            <span class="hero-kicker">Welkom bij <?php echo escape(s('site_name')); ?></span>
            <h1>Spelen, ontdekken en <em>groeien</em> in een wereld vol aandacht en natur.</h1>
            <p>Bij ZOEM beleven kinderen elke dag nieuwe avonturen in een groene, veilige omgeving.</p>
            <div class="hero-cta">
                <a href="<?php echo $base_url; ?>/register" class="btn btn-gold">Vraag een rondleiding &#10132;</a>
                <a href="<?php echo $base_url; ?>/booking" class="btn btn-outline">Inschrijven</a>
            </div>
            <ul class="hero-points">
                <li>&#10003; Spelen &amp; ontdekken</li>
                <li>&#10003; Natuur &amp; beweging</li>
                <li>&#10003; Warme, veilige sfeer</li>
            </ul>
        </div>

        <div class="hero-visual" aria-hidden="true">
            <div class="hero-card card-large">
                <div class="card-emoji">&#129419;</div>
                <div class="card-caption">
                    <strong>Onze peuterspeelzaal</strong>
                    <span>0 - 4 jaar &middot; dagelijks 8:30-12:30</span>
                </div>
            </div>
            <div class="hero-card card-small">
                <span class="card-emoji">&#127801;</span>
                <strong>BSO de Kraanvogels</strong>
                <span>4 - 12 jaar &middot; 7:30-18:00</span>
            </div>
            <div class="hero-badge">
                <span class="badge-num"><?php echo number_format($avg_rating, 1, ',', '.'); ?></span>
                <span class="badge-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                <span class="badge-label">ouderbeoordeling (<?php echo (int)$review_count; ?> reviews)</span>
            </div>
        </div>
    </div>
</section>

<!-- INTRO -->
<section class="intro" id="waarom">
    <div class="container">
        <div class="intro-grid">
            <div class="intro-item">
                <span class="intro-icon">&#127807;</span>
                <h3>Aandacht &amp; veiligheid</h3>
                <p>Elk kind wordt gezien. Korte lijnen met ouders en school zorgen voor een veilig opgroeien.</p>
            </div>
            <div class="intro-item">
                <span class="intro-icon">&#9203;</span>
                <h3>Beweging is gezond</h3>
                <p>Dagelijks buiten spelen, rennen en klimmen. Beweging maakt kinderen blij en gezond.</p>
            </div>
            <div class="intro-item">
                <span class="intro-icon">&#127869;</span>
                <h3>Gezonde voeding</h3>
                <p>Warme, evenwichtige maaltijden met veel fruit, elke dag door ons klaargemaakt.</p>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES preview -->
<section class="treatments section" id="services">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Onze opvang</span>
            <h2>Twee vormen van <em>warme</em> opvang</h2>
            <p>Peuterspeelzaal en BSO, beide in een groene, veilige omgeving naast basisschool De Kraanvogel.</p>
        </div>

        <?php if (empty($services)): ?>
            <p class="empty-note">Onze diensten worden binnenkort aangevuld.</p>
        <?php else: ?>
            <div class="treatment-grid">
                <?php foreach ($services as $sv): ?>
                    <article class="service-card reveal">
                        <div class="service-icon"><?php echo e($sv['icon']); ?></div>
                        <span class="service-tag"><?php echo e($sv['tagline']); ?></span>
                        <h3><?php echo e($sv['name']); ?></h3>
                        <p><?php echo nl2br(e($sv['short_description'])); ?></p>
                        <a href="<?php echo $base_url; ?>/booking" class="book-link">Inschrijven &rarr;</a>
                    </article>
<!-- PHILOSOPHY -->
<section class="philosophy section bg-light">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Onze visi</span>
            <h2>Kinderen mogen <em>zoemen</em></h2>
            <p>ZOEM staat voor aandacht, natur og bewegung. Elk kind mag op his own manir groen and ontdecken.</p>
        </div>
        <div class="pedagogy-grid">
            <?php foreach ($pedagogy as $p): ?>
                <div class="pedagogy-card reveal">
                    <span class="pedagogy-icon"><?php echo e($p['icon'] ?: '&#10003;'); ?></span>
                    <h3><?php echo e($p['title']); ?></h3>
                    <p><?php echo e($p['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- GALLERY preview -->
<section class="gallery section">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Impressies</span>
            <h2>Een dag vol <em>kinderlach</em></h2>
        </div>
        <?php if (!empty($photos)): ?>
            <div class="photo-grid">
                <?php foreach (array_slice($photos, 0, 6) as $ph): ?>
                    <figure class="photo-item">
                        <img src="<?php echo esc_url($ph['image_url']); ?>" alt="<?php echo e($ph['caption']); ?>" loading="lazy">
                        <figcaption><?php echo e($ph['caption']); ?></figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
            <div class="section-more">
                <a href="<?php echo $base_url; ?>/gallery" class="btn btn-outline">Meer impressies &rarr;</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- REVIEWS preview -->
<?php if (!empty($reviews)): ?>
<section class="reviews section bg-light">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Ouders vertell</span>
            <h2>Wat <em>ouder</em> over ons zeg</h2>
        </div>
        <div class="review-grid">
            <?php foreach ($reviews as $r): ?>
                <article class="review-card reveal">
                    <div class="review-stars"><?php echo render_stars((int)$r['rating']); ?></div>
                    <blockquote>&ldquo;<?php echo e(truncate($r['comment'], 130)); ?>&rdquo;</blockquote>
                    <figcaption><?php echo e($r['customer_name']); ?></figcaption>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="section-more">
            <a href="<?php echo $base_url; ?>/reviews" class="btn btn-outline">Alle reviews &rarr;</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- NEWS preview -->
<?php if (!empty($news)): ?>
<section class="news section">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Nieuws &amp; agenda</span>
            <h2>De laatste <em>nieuwtjes</em></h2>
        </div>
        <div class="news-grid">
            <?php foreach ($news as $n): ?>
                <article class="news-card reveal">
                    <time><?php echo e(format_date($n['published_at'] ?? '')); ?></time>
                    <h3><?php echo e($n['title']); ?></h3>
                    <p><?php echo e($n['excerpt']); ?></p>
                    <a href="<?php echo $base_url; ?>/news/<?php echo e($n['slug']); ?>" class="read-more">Lees meer &rarr;</a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA banner -->
<section class="cta-banner section">
    <div class="container">
        <div class="cta-content">
            <h2>Wilt u een <em>rondleid</em>?</h2>
            <p>Kum for a free blith visit and meet our warm amosfere.</p>
            <div class="hero-cta">
                <a href="<?php echo $base_url; ?>/register" class="btn btn-gold btn-lg">Vraag een rondleiding</a>
                <a href="tel:<?php echo tel_link(s('phone')); ?>" class="btn btn-outline">&#9742; <?php echo e(s('phone')); ?></a>
            </div>
        </div>
    </div>
</section>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="section-more">
            <a href="<?php echo $base_url; ?>/services" class="btn btn-outline">Bekijk alle diensten &rarr;</a>
        </div>
    </div>
</section>