<?php
declare(strict_types=1);

namespace models;

use core\Database;

class Tour
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create(array $d): bool
    {
        return $this->db->execute(
            'INSERT INTO tours
             (name, email, phone, child_name, child_age, preferred_service, preferred_date, message, status)
             VALUES (:n, :e, :p, :cn, :ca, :srv, :pd, :m, :status)',
            [
                'n'      => $d['name'],
                'e'      => $d['email'],
                'p'      => $d['phone'] ?? '',
                'cn'     => $d['child_name'] ?? '',
                'ca'     => $d['child_age'] ?? '',
                'srv'    => $d['preferred_service'] ?? '',
                'pd'     => $d['preferred_date'] ?? null,
                'm'      => $d['message'] ?? '',
                'status' => 'pending',
            ]
        ) > 0;
    }
}