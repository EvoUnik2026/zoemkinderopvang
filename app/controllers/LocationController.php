<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Location;

class LocationController extends Controller
{
    public function index(): void
    {
        $locations = (new Location())->getAll();

        $this->render('locations/index', [
            'page_title'       => 'Locaties - ' . s('site_name'),
            'meta_description' => 'Vind een ZOEM Kinderopvang locatie bij school de Kraanvogel in Vorden.',
            'locations'        => $locations,
        ]);
    }

    public function show(array $params = []): void
    {
        $slug = $params['any'] ?? ($params['slug'] ?? '');
        $loc  = (new Location())->getBySlug((string) $slug);

        if (!$loc) {
            $this->render('errors/404', [
                'page_title' => '404 - Locatie niet gevonden',
                'meta_description' => 'Locatie niet gevonden.',
            ]);
            return;
        }

        $this->render('locations/show', [
            'page_title'       => $loc['name'] . ' - ' . s('site_name'),
            'meta_description' => $loc['description'] ?? '',
            'location'         => $loc,
        ]);
    }
}