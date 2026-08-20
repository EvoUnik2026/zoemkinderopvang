<?php
declare(strict_types=1);

namespace models;

use core\Database;

class DaycareGroup
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM daycare_groups ORDER BY sort_order ASC');
    }

    public function getById(int $id): ?array
    {
        return $this->db->fetchOne('SELECT * FROM daycare_groups WHERE id = :id', ['id' => $id]);
    }
}