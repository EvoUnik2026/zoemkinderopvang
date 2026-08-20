<?php
/** @var array $user */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Parent portal</span>
        <h1>Hallo, <?php echo e($user['name'] ?? 'ouder'); ?>!</h1>
        <p>Welkom in het demo ouderportaal.</p>
    </div>
</section>

<section class="portal section">
    <div class="container">
        <div class="portal-grid">
            <div class="portal-card">
                <span class="portal-icon">&#9200;</span>
                <h3>Dagoverzicht</h3>
                <p>Bekijk wat uw kind vandaag heeft gegeten, gespeeld en geslapen.</p>
            </div>
            <div class="portal-card">
                <span class="portal-icon">&#128247;</span>
                <h3>Berichten</h3>
                <p>Laat een bericht achter voor de leidster.</p>
            </div>
            <div class="portal-card">
                <span class="portal-icon">&#128196;</span>
                <h3>Maaltijd</h3>
                <p>Geef voedselallergieën of voorkeuren door.</p>
            </div>
            <div class="portal-card">
                <span class="portal-icon">&#128247;</span>
                <h3>Account</h3>
                <p>E-mail: <?php echo e($user['email'] ?? ''); ?></p>
            </div>
        </div>

        <div class="center" style="margin:30px 0;">
            <a href="<?php echo $base_url; ?>/logout" class="btn btn-outline">Uitloggen</a>
        </div>
        <p class="text-muted">Dit is een visuele demo van het ouderportaal-concept, geïnspireerd op Partou. Er wordt geen echte data opgeslagen.</p>
    </div>
</section>