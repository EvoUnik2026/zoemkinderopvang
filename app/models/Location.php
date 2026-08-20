<?php
declare(strict_types=1);

namespace models;

use core\Database;

class Location
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM locations WHERE active = 1 ORDER BY name ASC');
    }

    public function getBySlug(string $slug): ?array
    {
        return $this->db->fetchOne(
            'SELECT * FROM locations WHERE slug = :slug AND active = 1',
            ['slug' => $slug]
        );
    }
}