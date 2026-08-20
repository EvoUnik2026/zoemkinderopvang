<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Faq;

class FaqController extends Controller
{
    public function index(): void
    {
        $faqs = (new Faq())->getAllActive();

        $this->render('faq/index', [
            'page_title'       => 'Veelgestelde vragen - ' . s('site_name'),
            'meta_description' => 'Antwoorden on common questions about our daycare.',
            'faqs'             => $faqs,
        ]);
    }
}