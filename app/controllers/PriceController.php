<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Price;
use models\DaycareGroup;

class PriceController extends Controller
{
    public function index(): void
    {
        $this->render('prices/index', [
            'page_title'       => 'Tarieven - ' . s('site_name'),
            'meta_description' => 'Transparent rates for peuterspeelzaal and BSO, plus the childcare calculator.',
            'prices'           => (new Price())->getAllActive(),
            'groups'           => (new DaycareGroup())->getAll(),
        ]);
    }

    /**
     * Calculates an estimated monthly net cost.
     * (demo calculator inspired by Raster Groep's rekentool)
     */
    public function calculate(): void
    {
        $hoursPerDay = max(1, min(12, (float) ($_GET['hours_per_day'] ?? 8)));
        $daysPerWeek = max(1, min(7,  (float) ($_GET['days_per_week'] ?? 5)));
        $rate        = max(0, (float) ($_GET['rate'] ?? 6.5));

        $grossDaily  = $hoursPerDay * $rate;
        $grossWeekly = $grossDaily * $daysPerWeek;
        $grossMonth  = $grossWeekly * 4.33;   // average days in a month
        $netEstimate = $grossMonth * 0.78;    // rough after Kinderopvangtoeslag

        $this->json([
            'net_per_month' => round($netEstimate, 2),
            'gross_week'    => round($grossWeekly, 2),
            'info'          => 'Estimated net cost after Kinderopvangtoeslag (indicative).',
        ]);
    }
}