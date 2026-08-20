<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Booking;
use models\Service;
use core\Logger;

class BookingController extends Controller
{
    public function index(): void
    {
        $this->render('booking/index', [
            'page_title'       => 'Inschrijven / afspraak - ' . s('site_name'),
            'meta_description' => 'Maak een afspraak or anmelden your child for daycare.',
            'services'         => (new Service())->getAll(),
        ]);
    }

    public function store(): void
    {
        if (!csrf_validate($_POST['csrf_token'] ?? '')) {
            $this->redirect('/booking', 'Ongeldig formulier. Probeer opnieuw.', 'error');
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $child = trim($_POST['child_name'] ?? '');
        $date  = trim($_POST['preferred_date'] ?? '');

        if ($name === '' || $email === '' || $child === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->redirect('/booking', 'Vul naam, kind and geldig e-mailadres in.', 'error');
        }

        (new Booking())->create([
            'name'           => $name,
            'email'          => $email,
            'phone'          => trim($_POST['phone'] ?? ''),
            'service_id'     => (int) ($_POST['service_id'] ?? 0),
            'child_name'     => $child,
            'child_age'      => trim($_POST['child_age'] ?? ''),
            'preferred_date' => $date ?: null,
            'preferred_time' => trim($_POST['preferred_time'] ?? '') ?: null,
            'notes'          => trim($_POST['notes'] ?? ''),
        ]);

        Logger::getInstance()->info('New booking (daycare application)', ['child' => $child]);
        $this->redirect('/booking', 'Uw aanvraag is ontvangen! Wij nemen binnen 24 uur contact op.', 'success');
    }
}