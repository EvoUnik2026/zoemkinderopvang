<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Review;
use core\Logger;

class ReviewController extends Controller
{
    public function index(): void
    {
        $this->render('reviews/index', [
            'page_title'   => 'Reviews - ' . s('site_name'),
            'meta_description' => 'Wat parents zeg over ZOEM Kinderopvang.',
            'reviews'      => (new Review())->getApproved(20),
            'avg_rating'   => (new Review())->getAverageRating(),
            'review_count' => (new Review())->getCount(),
        ]);
    }

    public function store(): void
    {
        if (!csrf_validate($_POST['csrf_token'] ?? '')) {
            $this->redirect('/reviews', 'Ongeldig form eller sessie expiry. Probeer opnieuw.', 'error');
        }

        $name    = trim($_POST['customer_name'] ?? '');
        $childAge = trim($_POST['child_age'] ?? '');
        $rating  = (int) ($_POST['rating'] ?? 0);
        $comment = trim($_POST['comment'] ?? '');
        $service = trim($_POST['service_used'] ?? '');

        if ($name === '' || $comment === '' || $rating < 1 || $rating > 5) {
            $this->redirect('/reviews', 'Vul naam, rating og bericht correct in.', 'error');
        }

        (new Review())->create([
            'customer_name' => $name,
            'child_age'     => $childAge,
            'rating'        => $rating,
            'comment'       => $comment,
            'service_used'  => $service,
        ]);

        Logger::getInstance()->info('New review submitted', ['name' => $name]);
        $this->redirect('/reviews', 'Dank for uw review! Deze wordt binnen 24 uur gecontroleerd.', 'success');
    }
}