<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Service;
use models\DaycareGroup;
use models\Price;
use models\OpeningHour;

class ServiceController extends Controller
{
    public function index(): void
    {
        $services = (new Service())->getAll();
        $groups   = (new DaycareGroup())->getAll();
        $prices   = (new Price())->getAllActive();
        $hours    = (new OpeningHour())->getAll();

        $this->render('services/index', [
            'page_title'       => 'Onze opvang - ' . s('site_name'),
            'meta_description' => 'Peuterspeelzaal & BSO: onze groepen, dagindeling en openingsuren.',
            'services'         => $services,
            'groups'           => $groups,
            'prices'           => $prices,
            'hours'            => $hours,
        ]);
    }
}