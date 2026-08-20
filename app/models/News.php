<?php
declare(strict_types=1);

namespace models;

use core\Database;

class News
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAllActive(): array
    {
        return $this->db->query(
            'SELECT * FROM news WHERE active = 1 ORDER BY published_at DESC, sort_order ASC'
        );
    }

    public function getBySlug(string $slug): ?array
    {
        return $this->db->fetchOne(
            'SELECT * FROM news WHERE slug = :slug AND active = 1',
            ['slug' => $slug]
        );
    }
}