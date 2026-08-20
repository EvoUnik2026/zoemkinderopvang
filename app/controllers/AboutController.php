<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Staff;

class AboutController extends Controller
{
    public function index(): void
    {
        $this->render('about/index', [
            'page_title'       => 'Over ons - ' . s('site_name'),
            'meta_description' => 'Leer meer over ZOEM Kinderopvang, onze visie, our founders and our team.',
            'staff'            => (new Staff())->getAll(),
        ]);
    }
}