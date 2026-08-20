<?php
declare(strict_types=1);

namespace models;

use core\Database;

class Pedagogy
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM pedagogy ORDER BY sort_order ASC');
    }
}