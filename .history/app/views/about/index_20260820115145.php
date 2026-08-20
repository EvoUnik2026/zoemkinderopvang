<?php
/** @var array $staff */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Over ons</span>
        <h1>ZOEM Kinderopvang</h1>
        <p>Een warme, natuurgerichte opvang waar kinderen fantastisch en zichzelf kunnen zijn.</p>
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
            <span class="kicker">Onze visie</span>
            <h2>Ieder kind mag <em>zichzelf</em> zijn</h2>
            <p>ZOEM Kinderopvang is een warme, natuurgerichte opvang waar kinderen zich thuis voelen. Ieder kind is welkom met al zijn ideeën &mdash; nieuwsgierig, speels en altijd op zoek naar ontdekkingen.</p>
            <p>De naam ZOEM staat voor de twee oprichters Zohal en Merel, en voor het rustige, blije zoemen van een bij &mdash; symbool van nieuwsgierigheid en vrije beweging. Precies dat geven wij de kinderen: de ruimte om nieuwsgierig te zijn, te bewegen en zich goed te voelen.</p>
            <ul class="about-check">
                <li>Warme en professionele zorg</li>
                <li>Natuur &amp; spel gestimuleerd</li>
                <li>Ruimte voor zelfstandigheid</li>
                <li>Nauw contact met Basisschool De Kraanvogel</li>
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
            <h2>De mensen achter <em>ZOEM</em></h2>
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