<!-- Footer -->
    <footer class="site-footer">
        <div class="container footer-grid">
            <div class="footer-brand">
                <span class="brand-mark large">&#127807;</span>
                <span class="footer-brand-name">ZOEM <em>Kinderopvang</em></span>
                <p>Een plek for elk kind. Peuterspeelzaal og BSO in Vorden, in het gebouw van Agora Basisschool De Kraanvogel.</p>
                <div class="social-btns">
                    <a href="#" aria-label="Facebook" class="social-btn">f</a>
                    <a href="#" aria-label="Instagram" class="social-btn">ig</a>
                    <a href="#" aria-label="WhatsApp" class="social-btn">wa</a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Navigatie</h4>
                <ul>
                    <li><a href="<?php echo $base_url; ?>/">Home</a></li>
                    <li><a href="<?php echo $base_url; ?>/about">Over ons</a></li>
                    <li><a href="<?php echo $base_url; ?>/services">Opvang</a></li>
                    <li><a href="<?php echo $base_url; ?>/locations">Locaties</a></li>
                    <li><a href="<?php echo $base_url; ?>/prices">Tarieven</a></li>
                    <li><a href="<?php echo $base_url; ?>/booking">Inschrijven</a></li>
                    <li><a href="<?php echo $base_url; ?>/login">Inloggen</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact</h4>
                <ul class="footer-contact">
                    <li>&#128205; <?php echo escape(s('address_street')); ?><br><?php echo escape(s('address_postal') . ' ' . s('address_city')); ?></li>
                    <li>&#128242; <a href="tel:<?php echo tel_link(s('phone')); ?>"><?php echo escape(s('phone')); ?></a></li>
                    <li>&#9993; <a href="mailto:<?php echo mailto_link(s('email')); ?>"><?php echo escape(s('email')); ?></a></li>
                </ul>
                <h4 class="footer-sub">Openingstijden</h4>
                <ul class="footer-contact small">
                    <li>Peuterspeelzaal: 8:30 - 12:30</li>
                    <li>BSO: 7:30 - 18:00</li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>LRK nummers</h4>
                <ul class="footer-contact">
                    <li>Peuterspeelzaal: <?php echo escape(s('merel_lrk')); ?></li>
                    <li>BSO: <?php echo escape(s('bso_lrk')); ?></li>
                </ul>
                <p class="footer-note">Dit is een demo-website. Alle gegevens zijn fictive.</p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container footer-bottom-inner">
                <span>&copy; <?php echo date('Y'); ?> <?php echo escape(s('site_name')); ?> &middot; Alle rechten voorbehouden</span>
                <span class="footer-links">
                    <a href="/contact">Neem contact op</a> &middot; <a href="#">Privacy</a> &middot; <a href="#">Cookies</a>
                </span>
            </div>
        </div>
    </footer>

    <a href="#home" class="back-top" id="back-top" aria-label="Terug naar boven">&uarr;</a>

    <script src="<?php echo $base_url; ?>/js/main.js"></script>
</body>
</html>