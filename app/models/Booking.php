<?php
declare(strict_types=1);

namespace models;

use core\Database;

class Booking
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create(array $d): bool
    {
        return $this->db->execute(
            'INSERT INTO bookings
             (name, email, phone, service_id, child_name, child_age, preferred_date, preferred_time, notes, status)
             VALUES (:n, :e, :p, :s, :cn, :ca, :pd, :pt, :no, :status)',
            [
                'n'      => $d['name'],
                'e'      => $d['email'],
                'p'      => $d['phone'] ?? '',
                's'      => $d['service_id'] ?? 0,
                'cn'     => $d['child_name'] ?? '',
                'ca'     => $d['child_age'] ?? '',
                'pd'     => $d['preferred_date'] ?? null,
                'pt'     => $d['preferred_time'] ?? null,
                'no'     => $d['notes'] ?? '',
                'status' => 'pending',
            ]
        ) > 0;
    }
}