<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\ContactMessage;
use core\Logger;

class ContactController extends Controller
{
    public function index(): void
    {
        $this->render('contact/index', [
            'page_title'       => 'Contact - ' . s('site_name'),
            'meta_description' => 'Neem contact op met ZOEM Kinderopvang.',
        ]);
    }

    public function store(): void
    {
        if (!csrf_validate($_POST['csrf_token'] ?? '')) {
            $this->redirect('/contact', 'Ongeldig formulier. Probeer opnieuw.', 'error');
        }

        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($name === '' || $email === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->redirect('/contact', 'Vul naam, e-mail and bericht in.', 'error');
        }

        (new ContactMessage())->create([
            'name'    => $name,
            'email'   => $email,
            'phone'   => trim($_POST['phone'] ?? ''),
            'subject' => trim($_POST['subject'] ?? ''),
            'message' => $message,
        ]);

        Logger::getInstance()->info('Contact message submitted', ['email' => $email]);
        $this->redirect('/contact', 'Dank for uw bericht! We look at it shortly.', 'success');
    }
}