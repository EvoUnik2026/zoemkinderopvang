<?php
declare(strict_types=1);

namespace models;

use core\Database;

class Setting
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        $rows = $this->db->query('SELECT key_name, `value` FROM settings');
        $result = [];
        foreach ($rows as $row) {
            $result[$row['key_name']] = $row['value'];
        }
        return $result;
    }

    public function get(string $key, string $default = ''): string
    {
        $row = $this->db->fetchOne('SELECT `value` FROM settings WHERE key_name = :key', ['key' => $key]);
        return $row['value'] ?? $default;
    }

    public function set(string $key, string $value): bool
    {
        return $this->db->execute(
            'INSERT INTO settings (key_name, `value`) VALUES (:k, :v)
             ON DUPLICATE KEY UPDATE `value` = :v',
            ['k' => $key, 'v' => $value]
        ) > 0;
    }
}