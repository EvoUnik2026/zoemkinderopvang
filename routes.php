<?php
/**
 * Route Definitionen - ZOEM Kinderopvang
 * Map each URL to a controller and method.
 */
declare(strict_types=1);

$routes = [
    // Main pages
    ['GET',  '/',            'controllers\HomeController', 'index'],
    ['GET',  '/home',        'controllers\HomeController', 'index'],
    ['GET',  '/about',       'controllers\AboutController', 'index'],

    // Services
    ['GET',  '/services',    'controllers\ServiceController', 'index'],

    // Locations / finder
    ['GET',  '/locations',   'controllers\LocationController', 'index'],
    ['GET',  '/location/{any}', 'controllers\LocationController', 'show'],

    // Tariffs + calculator
    ['GET',  '/prices',      'controllers\PriceController', 'index'],
    ['GET',  '/calculator',  'controllers\PriceController', 'calculate'],

    // Gallery
    ['GET',  '/gallery',     'controllers\GalleryController', 'index'],

    // Reviews
    ['GET',  '/reviews',     'controllers\ReviewController', 'index'],
    ['POST', '/reviews',     'controllers\ReviewController', 'store'],

    // FAQ
    ['GET',  '/faq',         'controllers\FaqController', 'index'],

    // News / agenda
    ['GET',  '/news',        'controllers\NewsController', 'index'],
    ['GET',  '/news/{any}',  'controllers\NewsController', 'show'],

    // Booking (inschreiben / dagverblijf apply)
    ['GET',  '/booking',     'controllers\BookingController', 'index'],
    ['POST', '/booking',     'controllers\BookingController', 'store'],

    // Registration / tour request
    ['GET',  '/register',    'controllers\TourController', 'index'],
    ['POST', '/register',    'controllers\TourController', 'store'],

    // Contact
    ['GET',  '/contact',     'controllers\ContactController', 'index'],
    ['POST', '/contact',     'controllers\ContactController', 'store'],

    // Parent portal (demo login concept)
    ['GET',  '/login',       'controllers\LoginController', 'index'],
    ['POST', '/login',       'controllers\LoginController', 'login'],
    ['GET',  '/portal',      'controllers\LoginController', 'portal'],
    ['GET',  '/logout',      'controllers\LoginController', 'logout'],
];