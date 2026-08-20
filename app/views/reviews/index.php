<?php
/** @var array $reviews */
/** @var float $avg_rating */
/** @var int $review_count */
?>

<section class="page-hero">
    <div class="container">
        <span class="kicker">Reviews</span>
        <h1>Wat ouders zeggen</h1>
        <p>Beoordeling: <strong><?php echo number_format($avg_rating, 1, ',', '.'); ?>/5</strong> op basis van <?php echo (int)$review_count; ?> reviews.</p>
    </div>
</section>

<section class="reviews section">
    <div class="container">
        <div class="section-head">
            <span class="kicker">Ouders vertellen</span>
            <h2>Recensies van <em>ouders</em></h2>
        </div>

        <form method="post" action="<?php echo $base_url; ?>/reviews" class="review-form" novalidate>
            <?php echo csrf_field(); ?>
            <h3>Plaats een review</h3>
            <div class="form-grid">
                <div class="field">
                    <label for="rev-name">Naam *</label>
                    <input type="text" id="rev-name" name="customer_name" required placeholder="Uw naam">
                </div>
                <div class="field">
                    <label for="rev-service">Opvang</label>
                    <select id="rev-service" name="service_used">
                        <option value="Peuterspeelzaal">Peuterspeelzaal</option>
                        <option value="BSO">BSO</option>
                    </select>
                </div>
                <div class="field">
                    <label for="rev-age">Leeftijd kind</label>
                    <input type="text" id="rev-age" name="child_age" placeholder="bijv. 3">
                </div>
                <div class="field">
                    <label for="rev-rating">Beoordeling *</label>
                    <select id="rev-rating" name="rating" required>
                        <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                        <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                        <option value="3">&#9733;&#9733;&#9733;</option>
                        <option value="2">&#9733;&#9733;</option>
                        <option value="1">&#9733;</option>
                    </select>
                </div>
                <div class="field field-full">
                    <label for="rev-comment">Uw ervaring *</label>
                    <textarea id="rev-comment" name="comment" rows="4" required placeholder="Deel uw ervaring..."></textarea>
                </div>
                <div class="field field-full form-submit">
                    <button type="submit" class="btn btn-gold">Verstuur review</button>
                </div>
            </div>
        </form>

        <?php if (!empty($reviews)): ?>
            <div class="reviews-list">
                <?php foreach ($reviews as $r): ?>
                    <article class="review-card reveal">
                        <div class="review-stars"><?php echo render_stars((int)$r['rating']); ?></div>
                        <blockquote>&ldquo;<?php echo e($r['comment']); ?>&rdquo;</blockquote>
                        <figcaption>
                            <?php echo e($r['customer_name']); ?>
                            <?php if ($r['service_used']): ?><span class="tag"><?php echo e($r['service_used']); ?></span><?php endif; ?>
                        </figcaption>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>