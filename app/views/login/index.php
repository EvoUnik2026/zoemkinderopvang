<section class="page-hero">
    <div class="container">
        <span class="kicker">Parent portal</span>
        <h1>Inloggen</h1>
        <p>Demo parent portal. In most real setups you would use the app (like Partou). Here we keep it simple.</p>
    </div>
</section>

<section class="login section">
    <div class="container" style="max-width:480px;">
        <div class="login-card">
            <h2>Welcome back</h2>
            <p>Fill in a name and/or e-mail to continue to the demo portal.</p>

            <form method="post" action="<?php echo $base_url; ?>/login" class="contact-form" novalidate>
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="lg-name">Naam</label>
                    <input type="text" id="lg-name" name="name" placeholder="Uw naam">
                </div>
                <div class="form-group">
                    <label for="lg-email">E-mailadres</label>
                    <input type="email" id="lg-email" name="email" placeholder="uw@email.nl">
                </div>
                <button type="submit" class="btn btn-gold btn-lg" style="width:100%;">Inloggen</button>
            </form>

            <p class="login-note">Demo only - no real data is stored. Use any name/email.</p>
        </div>
    </div>
</section>