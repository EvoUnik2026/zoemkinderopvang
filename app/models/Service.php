<?php
declare(strict_types=1);

namespace models;

use core\Database;

class Service
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM services WHERE active = 1 ORDER BY sort_order ASC');
    }

    public function getBySlug(string $slug): ?array
    {
        return $this->db->fetchOne(
            'SELECT * FROM services WHERE slug = :slug AND active = 1',
            ['slug' => $slug]
        );
    }
}