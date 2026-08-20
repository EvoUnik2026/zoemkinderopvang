<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use core\Logger;

/**
 * Demo parent portal (inspired by Partou's "Mijn Kinderopvang").
 * No real accounts are stored: a simple demo login is used.
 */
class LoginController extends Controller
{
    public function index(): void
    {
        if (isset($_SESSION['portal'])) {
            $this->redirect('/portal');
        }

        $this->render('login/index', [
            'page_title'       => 'Inloggen parent portal - ' . s('site_name'),
            'meta_description' => 'Demo parent portal for ZOEM Kinderopvang.',
        ]);
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $name  = trim($_POST['name'] ?? '');

        if (!csrf_validate($_POST['csrf_token'] ?? '')) {
            $this->redirect('/login', 'Ongeldig formulier.', 'error');
        }

        if ($email === '' && $name === '') {
            $this->redirect('/login', 'Enter a name and/or e-mail to continue.', 'error');
        }

        $_SESSION['portal'] = [
            'name'  => $name ?: 'Mia',
            'email' => $email,
        ];

        Logger::getInstance()->info('Parent portal demo login', ['email' => $email]);
        $this->redirect('/portal', 'Welcome to the parent portal!', 'success');
    }

    public function portal(): void
    {
        if (empty($_SESSION['portal'])) {
            $this->redirect('/login');
        }

        $this->render('login/portal', [
            'page_title' => 'Parent portal - ' . s('site_name'),
            'meta_description' => 'Demo parent portal.',
            'user'       => $_SESSION['portal'],
        ]);
    }

    public function logout(): void
    {
        unset($_SESSION['portal']);
        $this->redirect('/login', 'Je bent uitgeloggen.', 'success');
    }
}