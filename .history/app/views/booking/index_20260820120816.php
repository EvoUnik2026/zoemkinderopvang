<?php
/** @var array $services */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Inschrijven</span>
        <h1>Afspraak &amp; inschrijving</h1>
        <p>Vul het formulier in en wij nemen binnen 24 uur contact met u op om de plek te bevestigen.</p>
    </div>
</section>

<section class="booking section">
    <div class="container">
        <div class="content-grid">
            <div>
                <h2>Online afspraak</h2>
                <p class="lead">Kies een opvangvorm en een gewenste datum. Wij nemen contact op om de aanvraag te bevestigen.</p>

                <form method="post" action="<?php echo $base_url; ?>/booking" class="contact-form" novalidate>
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="bk-name">Naam ouder *</label>
                        <input type="text" id="bk-name" name="name" required placeholder="Uw naam">
                    </div>
                    <div class="form-group">
                        <label for="bk-email">E-mailadres *</label>
                        <input type="email" id="bk-email" name="email" required placeholder="uw@email.nl">
                    </div>
                    <div class="form-group">
                        <label for="bk-phone">Telefoon</label>
                        <input type="tel" id="bk-phone" name="phone" placeholder="06-12345678">
                    </div>
                    <div class="form-group">
                        <label for="bk-service">Opvang</label>
                        <select id="bk-service" name="service_id">
                            <option value="0">Kies een opvang</option>
                            <?php foreach ($services as $sv): ?>
                                <option value="<?php echo (int)$sv['id']; ?>"><?php echo e($sv['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bk-child">Naam kind *</label>
                        <input type="text" id="bk-child" name="child_name" required placeholder="Naam van uw kind">
                    </div>
                    <div class="form-group">
                        <label for="bk-age">Leeftijd kind</label>
                        <input type="text" id="bk-age" name="child_age" placeholder="bijv. 3">
                    </div>
                    <div class="form-group">
                        <label for="bk-date">Voorkeur datum</label>
                        <input type="date" id="bk-date" name="preferred_date">
                    </div>
                    <div class="form-group">
                        <label for="bk-time">Voorkeur tijd</label>
                        <input type="time" id="bk-time" name="preferred_time">
                    </div>
                    <div class="form-group">
                        <label for="bk-notes">Opmerkingen</label>
                        <textarea id="bk-notes" name="notes" rows="3" placeholder="Overig dat u wilt delen..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-gold btn-lg">Verstuur aanvraag</button>
                </form>
            </div>

            <div class="side-info">
                <h2>Hoe het werkt</h2>
                <div class="steps-list">
                    <div class="step-item"><span>1</span><div><strong>Formulier invullen</strong><p>Vul uw gegevens en voorkeursdatum in.</p></div></div>
                    <div class="step-item"><span>2</span><div><strong>Contact</strong><p>Wij bellen u binnen 24 uur.</p></div></div>
                    <div class="step-item"><span>3</span><div><strong>Rondleiding</strong><p>Plan een bezoek of afspraak.</p></div></div>
                    <div class="step-item"><span>4</span><div><strong>Start opvang</strong><p>Uw kind kan starten.</p></div></div>
                </div>
                <div class="side-callout">
                    <strong>Vragen?</strong>
                    <p>Bel ons direct: <a href="tel:<?php echo tel_link(s('phone')); ?>"><?php echo e(s('phone')); ?></a></p>
                </div>
            </div>
        </div>
    </div>
</section>