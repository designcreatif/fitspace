<?php

class Reservation
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create(
        int $userId,
        int $articleId,
        string $date
    ): bool {

        $stmt = $this->db->prepare("
            INSERT INTO reservations
            (user_id, article_id, reservation_date, status)
            VALUES (?, ?, ?, 'confirmed')
        ");

        return $stmt->execute([
            $userId,
            $articleId,
            $date
        ]);
    }

    public function exists(int $userId, int $articleId): bool
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*)
            FROM reservations
            WHERE user_id = ?
            AND article_id = ?
            AND status = 'confirmed'
        ");

        $stmt->execute([
            $userId,
            $articleId
        ]);

        return (int) $stmt->fetchColumn() > 0;
    }
    public function cancel(int $reservationId): bool
{
    $stmt = $this->db->prepare("
        UPDATE reservations
        SET status = 'cancelled'
        WHERE id = ?
    ");

    return $stmt->execute([$reservationId]);
}

public function all(): array
{
    $stmt = $this->db->query("
        SELECT
            r.id,
            r.reservation_date,
            r.status,
            u.first_name,
            u.last_name,
            a.title
        FROM reservations r
        INNER JOIN users u
            ON u.id = r.user_id
        INNER JOIN articles a
            ON a.id = r.article_id
        ORDER BY r.reservation_date DESC
    ");

    return $stmt->fetchAll();
}
}