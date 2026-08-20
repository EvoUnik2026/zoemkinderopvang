<?php
/** @var array $services */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Rondleiding</span>
        <h1>Vraag een rondleiding aan</h1>
        <p>Free and non-binding. Proef the warm atmosphere and see the group.</p>
    </div>
</section>

<section class="register section">
    <div class="container" style="max-width:860px;">
        <h2>Plan u visit</h2>
        <p class="lead">Vul the formulier in, choose en opvang and a preferred date. We confirm your visit promptly.</p>

        <form method="post" action="<?php echo $base_url; ?>/register" class="contact-form" novalidate>
            <?php echo csrf_field(); ?>
            <div class="form-grid">
                <div class="field">
                    <label for="rg-name">Naam ouder *</label>
                    <input type="text" id="rg-name" name="name" required placeholder="Uw naam">
                </div>
                <div class="field">
                    <label for="rg-email">E-mailadres *</label>
                    <input type="email" id="rg-email" name="email" required placeholder="uw@email.nl">
                </div>
                <div class="field">
                    <label for="rg-phone">Telefoon</label>
                    <input type="tel" id="rg-phone" name="phone" placeholder="06-12345678">
                </div>
                <div class="field">
                    <label for="rg-service">Voorkeur opvang</label>
                    <select id="rg-service" name="preferred_service">
                        <option value="">Kies een opvang</option>
                        <?php foreach ($services as $sv): ?>
                            <option value="<?php echo e($sv['name']); ?>"><?php echo e($sv['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field">
                    <label for="rg-childname">Naam kind</label>
                    <input type="text" id="rg-childname" name="child_name" placeholder="Naam van uw kind">
                </div>
                <div class="field">
                    <label for="rg-childage">Leeftijd kind</label>
                    <input type="text" id="rg-childage" name="child_age" placeholder="bijv. 3">
                </div>
                <div class="field field-full">
                    <label for="rg-date">Voorkeur datum</label>
                    <input type="date" id="rg-date" name="preferred_date">
                </div>
                <div class="field field-full">
                    <label for="rg-msg">Bericht</label>
                    <textarea id="rg-msg" name="message" rows="4" placeholder="Anything you would like to share..."></textarea>
                </div>
                <div class="field field-full form-submit">
                    <button type="submit" class="btn btn-gold btn-lg">Verstuur verzoek</button>
                </div>
            </div>
        </form>
    </div>
</section>