<?php
declare(strict_types=1);

namespace models;

use core\Database;

class Review
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getApproved(int $limit = 12): array
    {
        return $this->db->query(
            'SELECT * FROM reviews WHERE approved = 1 ORDER BY created_at DESC LIMIT :limit',
            ['limit' => $limit]
        );
    }

    public function getAverageRating(): float
    {
        $row = $this->db->fetchOne('SELECT AVG(rating) AS avg FROM reviews WHERE approved = 1');
        return round((float)($row['avg'] ?? 0), 1);
    }

    public function getCount(): int
    {
        $row = $this->db->fetchOne('SELECT COUNT(*) AS cnt FROM reviews WHERE approved = 1');
        return (int)($row['cnt'] ?? 0);
    }

    public function create(array $data): bool
    {
        return $this->db->execute(
            'INSERT INTO reviews (customer_name, child_age, rating, comment, service_used, approved, created_at)
             VALUES (:n, :ca, :r, :c, :s, 0, NOW())',
            [
                'n'  => $data['customer_name'],
                'ca' => $data['child_age'] ?? '',
                'r'  => $data['rating'],
                'c'  => $data['comment'],
                's'  => $data['service_used'] ?? '',
            ]
        ) > 0;
    }
}