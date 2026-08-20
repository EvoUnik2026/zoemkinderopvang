<?php
/** @var array $faqs */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Veelgestelde vragen</span>
        <h1>FAQ</h1>
        <p>Snel antwoorden op de veelgestelde vragen over onze opvang.</p>
    </div>
</section>

<section class="faq section">
    <div class="container">
        <?php if (empty($faqs)): ?>
            <p class="empty-note">Er zijn momenteel geen veelgestelde vragen.</p>
        <?php else: ?>
            <div class="faq-list">
                <?php foreach ($faqs as $f): ?>
                    <div class="faq-item reveal">
                        <button class="faq-question" aria-expanded="false">
                            <span><?php echo e($f['question']); ?></span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p><?php echo nl2br(e($f['answer'])); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="center" style="margin-top:40px;">
            <p>Niet gevonden wat u zocht? Neem contact op.</p>
            <a href="<?php echo $base_url; ?>/contact" class="btn btn-gold">Contact opnemen</a>
        </div>
    </div>
</section>