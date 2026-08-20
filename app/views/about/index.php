<?php
/** @var array $staff */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Over ons</span>
        <h1>ZOEM Kinderopvang</h1>
        <p>Een warme, naturigerichte opvang where children fantastic and can be themselves.</p>
    </div>
</section>

<section class="about section">
    <div class="container about-grid">
        <div class="about-visual" aria-hidden="true">
            <div class="about-frame">
                <div class="about-emoji">&#128522;</div>
                <div class="about-deco deco-a"></div>
                <div class="about-deco deco-b"></div>
            </div>
            <div class="about-exp">
                <strong>Sinds <?php echo escape(s('since_year', '2024')); ?></strong>
                <span>natuurgroeien in een veilige sfeer</span>
            </div>
        </div>

        <div class="about-content">
            <span class="kicker">Onze visi</span>
            <h2>Child may <em>be</em> himself</h2>
            <p>ZOEM Kinderopvang in een warme, naturgerichte opvang where children feel at home. Each child is welcome with all its ideas &mdash; curious, playful and always looking to discover.</p>
            <p>The name ZOEM stands for the two founders Zohal and Merel, and for the calm, happy hum of a bee &mdash; symbol of curiosity and free movement. It is exactly what we give the children: the space to be curious, to move and to be well.</p>
            <ul class="about-check">
                <li>Warm and professional care</li>
                <li>Nature &amp; play supported</li>
                <li>Opportunity for self-reliance</li>
                <li>Close contact with Basisschool De Kraanvogel</li>
            </ul>
            <div class="about-cta">
                <a href="<?php echo $base_url; ?>/booking" class="btn btn-gold">Inschrijven</a>
                <a href="<?php echo $base_url; ?>/contact" class="btn btn-outline dark">Neem contact op</a>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($staff)): ?>
<section class="team section bg-light">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Ons team</span>
            <h2>Liefde people behind <em>ZOEM</em></h2>
        </div>
        <div class="team-grid">
            <?php foreach ($staff as $m): ?>
                <article class="team-card reveal">
                    <div class="team-avatar">
                        <?php if ($m['photo_url']): ?>
                            <img src="<?php echo esc_url($m['photo_url']); ?>" alt="<?php echo e($m['name']); ?>" loading="lazy">
                        <?php else: ?>
                            <span><?php echo e(strtoupper(substr($m['name'], 0, 1))); ?></span>
                        <?php endif; ?>
                    </div>
                    <h3><?php echo e($m['name']); ?></h3>
                    <span class="team-role"><?php echo e($m['role']); ?></span>
                    <p><?php echo e($m['bio']); ?></p>
                    <span class="team-edu"><?php echo e($m['education']); ?></span>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>