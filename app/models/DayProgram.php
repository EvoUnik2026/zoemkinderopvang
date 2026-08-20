<?php
declare(strict_types=1);

namespace models;

use core\Database;

class DayProgram
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        return $this->db->query(
            'SELECT * FROM day_program WHERE active = 1
             ORDER BY day_of_week ASC, start_time ASC'
        );
    }
}