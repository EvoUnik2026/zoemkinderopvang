<?php
/** @var array $prices */
/** @var array $groups */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Tarieven</span>
        <h1>Transparante tarieven</h1>
        <p>Alle tarieven inbegrepen hadig of the day and verse fruit. Kinderopvangtoeslag can reduce the net costs.</p>
    </div>
</section>

<?php if (!empty($prices)): ?>
<section class="pricing section">
    <div class="container">
        <div class="pricing-grid">
            <?php foreach ($prices as $p): ?>
                <div class="pricing-card reveal">
                    <h3><?php echo e($p['group_name']); ?></h3>
                    <span class="pricing-age"><?php echo e($p['age_range']); ?></span>
                    <div class="pricing-amount">
                        <?php if ($p['price_per_day']): ?>
                            <strong><?php echo format_euro((float)$p['price_per_day']); ?></strong>
                            <span>per dag</span>
                        <?php elseif ($p['price_per_hour']): ?>
                            <strong><?php echo format_euro((float)$p['price_per_hour']); ?></strong>
                            <span>per uur</span>
                        <?php endif; ?>
                    </div>
                    <p><?php echo e($p['label']); ?></p>
                    <p class="pricing-desc"><?php echo e($p['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Calculator -->
<section class="calculator section bg-light">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Rekentool</span>
            <h2>Calculate uw <em>net cost</em></h2>
            <p>Indicative net monthly rate after Kinderopvangtoeslag.</p>
        </div>
        <div class="calc-form">
            <div class="form-grid">
                <div class="field">
                    <label for="calc-hours">Uren per dag</label>
                    <input type="number" id="calc-hours" value="8" min="1" max="12">
                </div>
                <div class="field">
                    <label for="calc-days">Dage per week</label>
                    <input type="number" id="calc-days" value="5" min="1" max="7">
                </div>
                <div class="field">
                    <label for="calc-rate">Tarife per hour (&euro;)</label>
                    <input type="number" id="calc-rate" value="6.50" min="0" step="0.5">
                </div>
                <div class="field form-submit">
                    <button type="button" class="btn btn-gold" id="calc-run">Bereken</button>
                </div>
            </div>
            <div class="calc-result" id="calc-result"></div>
        </div>
    </div>
</section>

<div class="center" style="margin:30px 0;">
    <a href="<?php echo $base_url; ?>/booking" class="btn btn-gold btn-lg">Inschrijven</a>
</div>