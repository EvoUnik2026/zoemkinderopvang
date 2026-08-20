<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo escape($page_title ?? s('site_name')); ?></title>
    <meta name="description" content="<?php echo escape($meta_description ?? s('tagline')); ?>">
    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo escape($page_title ?? ''); ?>">
    <meta property="og:description" content="<?php echo escape($meta_description ?? ''); ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="nl_NL">

    <!-- Fonts: Playfair Display + Lato -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='15' fill='%234CAF50'/%3E%3Ctext x='16' y='22' font-size='16' text-anchor='middle'%3E%F0%9F%90%9D%3C/text%3E%3C/svg%3E">
</head>
<body>
    <!-- Flash messages -->
    <?php if (!empty($flashes)): ?>
    <div class="flash-messages">
        <?php foreach ($flashes as $type => $message): ?>
        <div class="flash flash-<?php echo escape($type); ?>">
            <span class="flash-icon"><?php echo $type === 'success' ? '&#10003;' : '&#9888;'; ?></span>
            <?php echo escape($message); ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Top bar -->
    <div class="topbar">
        <div class="container topbar-inner">
            <div class="topbar-left">
                <a href="tel:<?php echo tel_link(s('phone')); ?>">&#9742; <?php echo escape(s('phone')); ?></a>
                <span class="sep">|</span>
                <a href="mailto:<?php echo mailto_link(s('email')); ?>">&#9993; <?php echo escape(s('email')); ?></a>
            </div>
            <div class="topbar-right">
                <span><?php echo escape(s('address_street')); ?>, <?php echo escape(s('address_postal') . ' ' . s('address_city')); ?></span>
                <span class="sep">|</span>
                <span class="topbar-highlight">&#127807; Natuurlijk opgroeien</span>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="site-header" id="site-header">
        <div class="container header-inner">
            <a href="<?php echo $base_url; ?>/" class="brand" aria-label="Home">
                <span class="brand-mark" aria-hidden="true">&#127807;</span>
                <span class="brand-text">
                    <span class="brand-name">ZOEM <em>Kinderopvang</em></span>
                    <span class="brand-sub">peuterspeelzaal &amp; BSO</span>
                </span>
            </a>

            <nav class="site-nav" id="site-nav" aria-label="Hoofdnavigatie">
                <ul>
                    <li><a href="<?php echo $base_url; ?>/"<?php echo is_active('/'); ?>>Home</a></li>
                    <li><a href="<?php echo $base_url; ?>/about"<?php echo is_active('/about'); ?>>Over ons</a></li>
                    <li><a href="<?php echo $base_url; ?>/services"<?php echo is_active('/services'); ?>>Opvang</a></li>
                    <li><a href="<?php echo $base_url; ?>/locations"<?php echo is_active('/locations'); ?>>Locaties</a></li>
                    <li><a href="<?php echo $base_url; ?>/prices"<?php echo is_active('/prices'); ?>>Tarieven</a></li>
                    <li><a href="<?php echo $base_url; ?>/gallery"<?php echo is_active('/gallery'); ?>>Impressies</a></li>
                    <li><a href="<?php echo $base_url; ?>/news"<?php echo is_active('/news'); ?>>Nieuws</a></li>
                    <li><a href="<?php echo $base_url; ?>/faq"<?php echo is_active('/faq'); ?>>FAQ</a></li>
                    <li><a href="<?php echo $base_url; ?>/contact"<?php echo is_active('/contact'); ?>>Contact</a></li>
                </ul>
                <div class="nav-cta-group">
                    <a href="<?php echo $base_url; ?>/register" class="btn btn-outline btn-nav">Rondleiding</a>
                    <a href="<?php echo $base_url; ?>/login" class="btn btn-gold btn-nav">Inloggen</a>
                </div>
            </nav>

            <button class="nav-toggle" id="nav-toggle" aria-label="Menu openen" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </header>