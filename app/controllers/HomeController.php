<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Service;
use models\Review;
use models\News;
use models\Pedagogy;
use models\Photo;
use core\Logger;

class HomeController extends Controller
{
    public function index(): void
    {
        Logger::getInstance()->info('Home page rendered');

        $services  = (new Service())->getAll();
        $reviews   = (new Review())->getApproved(3);
        $pics      = (new Photo())->getAll();
        $news      = (new News())->getAllActive();
        $pedagogy  = (new Pedagogy())->getAll();

        $avg  = (new Review())->getAverageRating();
        $cnt  = (new Review())->getCount();
        $since = (int) s('since_year', '2024');
        $years = max(1, (int) date('Y') - $since);

        $this->render('home/index', [
            'page_title'       => s('site_name') . ' - kinderopvang & dagverblijf in Vorden',
            'meta_description' => s('tagline'),
            'services'         => $services,
            'reviews'          => $reviews,
            'photos'           => array_slice($pics, 0, 6),
            'news'             => array_slice($news, 0, 3),
            'pedagogy'         => $pedagogy,
            'avg_rating'       => $avg,
            'review_count'     => $cnt,
            'years'            => $years,
        ]);
    }
}