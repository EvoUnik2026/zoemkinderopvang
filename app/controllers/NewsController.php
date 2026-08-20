<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\News;

class NewsController extends Controller
{
    public function index(): void
    {
        $news = (new News())->getAllActive();

        $this->render('news/index', [
            'page_title'       => 'Nieuws & agenda - ' . s('site_name'),
            'meta_description' => 'Laatste nieuws and agenda from ZOEM Kinderopvang.',
            'news'             => $news,
        ]);
    }

    public function show(array $params = []): void
    {
        $slug = $params['any'] ?? '';
        $item = (new News())->getBySlug((string) $slug);

        if (!$item) {
            $this->render('errors/404', [
                'page_title' => '404 - Nieuws niet gevonden',
                'meta_description' => 'Nieuwsartikel niet gevonden.',
            ]);
            return;
        }

        $this->render('news/show', [
            'page_title'       => $item['title'] . ' - ' . s('site_name'),
            'meta_description' => $item['excerpt'] ?? '',
            'item'             => $item,
        ]);
    }
}