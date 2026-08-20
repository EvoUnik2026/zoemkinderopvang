<?php
declare(strict_types=1);

namespace models;

use core\Database;

class ContactMessage
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create(array $d): bool
    {
        return $this->db->execute(
            'INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (:n, :e, :p, :s, :m)',
            [
                'n' => $d['name'],
                'e' => $d['email'],
                'p' => $d['phone'] ?? '',
                's' => $d['subject'] ?? '',
                'm' => $d['message'],
            ]
        ) > 0;
    }
}