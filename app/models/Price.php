<?php
declare(strict_types=1);

namespace models;

use core\Database;

class Price
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAllActive(): array
    {
        return $this->db->query(
            'SELECT p.*, dg.name AS group_name, dg.slug AS group_slug
             FROM prices p
             INNER JOIN daycare_groups dg ON dg.id = p.group_id
             WHERE p.active = 1
             ORDER BY dg.sort_order ASC, p.sort_order ASC'
        );
    }
}