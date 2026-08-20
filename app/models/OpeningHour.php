<?php
declare(strict_types=1);

namespace models;

use core\Database;

class OpeningHour
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getByService(string $serviceSlug): array
    {
        return $this->db->query(
            'SELECT * FROM opening_hours WHERE service_slug = :s ORDER BY day_of_week ASC',
            ['s' => $serviceSlug]
        );
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM opening_hours ORDER BY service_slug ASC, day_of_week ASC');
    }
}