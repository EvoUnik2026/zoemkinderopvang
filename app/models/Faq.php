<?php
declare(strict_types=1);

namespace models;

use core\Database;

class Faq
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAllActive(): array
    {
        return $this->db->query('SELECT * FROM faqs WHERE active = 1 ORDER BY sort_order ASC');
    }
}