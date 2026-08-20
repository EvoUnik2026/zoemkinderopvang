<section class="page-hero">
    <div class="container">
        <span class="kicker">Contact</span>
        <h1>Neem contact op</h1>
        <p>Vragen, rondleiding of inschrijving? Wij helpen graag.</p>
    </div>
</section>

<section class="contact section">
    <div class="container">
        <div class="content-grid">
            <div class="contact-form-card">
                <h2>Stuur ons een bericht</h2>
                <form method="post" action="<?php echo $base_url; ?>/contact" class="contact-form" novalidate>
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="ct-name">Naam ouder *</label>
                        <input type="text" id="ct-name" name="name" required placeholder="Uw naam">
                    </div>
                    <div class="form-group">
                        <label for="ct-email">E-mailadres *</label>
                        <input type="email" id="ct-email" name="email" required placeholder="uw@email.nl">
                    </div>
                    <div class="form-group">
                        <label for="ct-phone">Telefoon</label>
                        <input type="tel" id="ct-phone" name="phone" placeholder="06-12345678">
                    </div>
                    <div class="form-group">
                        <label for="ct-subject">Onderwerp</label>
                        <input type="text" id="ct-subject" name="subject" placeholder="Waar het over">
                    </div>
                    <div class="form-group">
                        <label for="ct-message">Bericht *</label>
                        <textarea id="ct-message" name="message" rows="5" required placeholder="Uw bericht..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-gold btn-lg">Verstuur bericht</button>
                </form>
            </div>

            <div class="contact-info">
                <h2>Contactgegevens</h2>
                <div class="contact-item"><span>&#128205;</span><div><strong>Bezoekadres</strong><p><?php echo e(s('address_street')); ?><br><?php echo e(s('address_postal') . ' ' . s('address_city')); ?></p></div></div>
                <div class="contact-item"><span>&#9742;</span><div><strong>Telefoon</strong><p><a href="tel:<?php echo tel_link(s('phone')); ?>"><?php echo e(s('phone')); ?></a></p></div></div>
                <div class="contact-item"><span>&#9993;</span><div><strong>E-mail</strong><p><a href="mailto:<?php echo mailto_link(s('email')); ?>"><?php echo e(s('email')); ?></a></p></div></div>
                <div class="contact-item"><span>&#9200;</span><div><strong>Openingstijden</strong><p>Peuterspeelzaal: 8:30-12:30<br>BSO: 7:30-18:00</p></div></div>

                <div class="contact-map">
                    <iframe src="<?php echo s('address_street') ? 'https://maps.google.com/maps?q=Vorden,Eikenlaan+22&output=embed' : ''; ?>" width="100%" height="240" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>