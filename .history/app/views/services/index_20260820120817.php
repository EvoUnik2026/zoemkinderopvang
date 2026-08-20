<?php
/** @var array $services */
/** @var array $groups */
/** @var array $prices */
/** @var array $hours */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Onze opvang</span>
        <h1>Peuterspeelzaal &amp; BSO</h1>
        <p>Twee warme opvangvormen. Kinderen ontdekken en spelen in een veilige groene omgeving.</p>
    </div>
</section>

<section class="treatments section">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Kies uw opvang</span>
            <h2>Welke <em>opvang</em> past bij u?</h2>
        </div>

        <?php if (empty($services)): ?>
            <p class="empty-note">Onze diensten worden binnenkort aangevuld.</p>
        <?php else: ?>
            <div class="service-detail-grid">
                <?php foreach ($services as $sv): ?>
                    <article class="service-card-large reveal">
                        <div class="service-icon large"><?php echo e($sv['icon']); ?></div>
                        <span class="service-tag"><?php echo e($sv['tagline']); ?></span>
                        <h3><?php echo e($sv['name']); ?></h3>
                        <p><?php echo nl2br(e($sv['description'])); ?></p>
                        <a href="<?php echo $base_url; ?>/booking" class="btn btn-gold">Inschrijven hier</a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php if (!empty($groups)): ?>
<section class="groups section bg-light">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Groepen</span>
            <h2>Onze warme <em>groepen</em></h2>
        </div>
        <div class="groups-grid">
            <?php foreach ($groups as $g): ?>
                <div class="group-card reveal">
                    <h3><?php echo e($g['name']); ?></h3>
                    <span class="group-age"><?php echo e((string)(float)$g['age_min']); ?> - <?php echo e((string)(float)$g['age_max']); ?> jaar</span>
                    <p><?php echo e($g['description']); ?></p>
                    <span class="group-max">Max. <?php echo (int)$g['max_children']; ?> kinderen</span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($hours)): ?>
<section class="hours section">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Openingstijden</span>
            <h2>Onze <em>openingstijden</em> voor u</h2>
        </div>
        <div class="hours-grid">
            <?php
                $byService = [];
                foreach ($hours as $h) {
                    $byService[$h['service_slug']][] = $h;
                }
            ?>
            <?php foreach ($byService as $slug => $list): ?>
                <div class="hours-card">
                    <h3><?php echo e(ucfirst(str_replace('_', ' ', $slug))); ?></h3>
                    <ul class="hours-list">
                        <?php foreach ($list as $h): ?>
                            <li>
                                <span><?php echo e(name_of_day((int)$h['day_of_week'])); ?></span>
                                <strong><?php echo $h['closed'] ? 'Gesloten' : e(format_time($h['opens_at'])) . ' - ' . e(format_time($h['closes_at'])); ?></strong>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>