<?php
/** @var array $user */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Parent portal</span>
        <h1>Halló, <?php echo e($user['name'] ?? 'parent'); ?>!</h1>
        <p>Welcome to the demo parent portal.</p>
    </div>
</section>

<section class="portal section">
    <div class="container">
        <div class="portal-grid">
            <div class="portal-card">
                <span class="portal-icon">&#9200;</span>
                <h3>Dagoverzicht</h3>
                <p>See what your child ate, played and slept today.</p>
            </div>
            <div class="portal-card">
                <span class="portal-icon">&#128247;</span>
                <h3>Loopen</h3>
                <p>Leave a message for the leidster.</p>
            </div>
            <div class="portal-card">
                <span class="portal-icon">&#128196;</span>
                <h3>Maaltijd</h3>
                <p>Meld food allergies or preferences.</p>
            </div>
            <div class="portal-card">
                <span class="portal-icon">&#128247;</span>
                <h3>Konto</h3>
                <p>E-mail: <?php echo e($user['email'] ?? ''); ?></p>
            </div>
        </div>

        <div class="center" style="margin:30px 0;">
            <a href="<?php echo $base_url; ?>/logout" class="btn btn-outline">Uitloggen</a>
        </div>
        <p class="text-muted">This is a visual demo of the parent app concept inspired by Partou. No real data is stored.</p>
    </div>
</section>