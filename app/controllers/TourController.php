<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Tour;
use models\Service;
use core\Logger;

class TourController extends Controller
{
    public function index(): void
    {
        $this->render('register/index', [
            'page_title'       => 'Vraag een rondleiding aan - ' . s('site_name'),
            'meta_description' => 'Plan een vrijblijvende rondleiding at ZOEM Kinderopvang.',
            'services'         => (new Service())->getAll(),
        ]);
    }

    public function store(): void
    {
        if (!csrf_validate($_POST['csrf_token'] ?? '')) {
            $this->redirect('/register', 'Ongeldig formulier. Probeer opnieuw.', 'error');
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($name === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->redirect('/register', 'Vul naam and geldig e-mailadres in.', 'error');
        }

        (new Tour())->create([
            'name'              => $name,
            'email'             => $email,
            'phone'             => trim($_POST['phone'] ?? ''),
            'child_name'        => trim($_POST['child_name'] ?? ''),
            'child_age'         => trim($_POST['child_age'] ?? ''),
            'preferred_service' => trim($_POST['preferred_service'] ?? ''),
            'preferred_date'    => trim($_POST['preferred_date'] ?? '') ?: null,
            'message'           => trim($_POST['message'] ?? ''),
        ]);

        Logger::getInstance()->info('Tour (rondleiding) requested', ['name' => $name]);
        $this->redirect('/register', 'Dank for uw verzoek! We contact u kort.', 'success');
    }
}