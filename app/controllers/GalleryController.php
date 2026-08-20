<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Photo;

class GalleryController extends Controller
{
    public function index(): void
    {
        $this->render('gallery/index', [
            'page_title'       => 'Impressies - ' . s('site_name'),
            'meta_description' => 'Foto galerie of daily life at ZOEM Kinderopvang.',
            'photos'           => (new Photo())->getAll(),
        ]);
    }
}