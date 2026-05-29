<?php

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT
                id,
                first_name,
                last_name,
                username,
                email,
                role,
                avatar,
                membership,
                created_at
             FROM users
             WHERE id = ?'
        );

        $stmt->execute([$id]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findByIdWithPassword(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findByResetToken(string $token): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM users
             WHERE reset_token = ?
             AND reset_expires > NOW()'
        );

        $stmt->execute([$token]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function usernameExists(string $username, ?int $excludeId = null): bool
    {
        $sql = 'SELECT COUNT(*) FROM users WHERE username = ?';

        $params = [$username];

        if ($excludeId) {
            $sql .= ' AND id != ?';
            $params[] = $excludeId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        $sql = 'SELECT COUNT(*) FROM users WHERE email = ?';

        $params = [$email];

        if ($excludeId) {
            $sql .= ' AND id != ?';
            $params[] = $excludeId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO users
            (first_name, last_name, username, email, password, role)
            VALUES (?, ?, ?, ?, ?, ?)'
        );

        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['role'] ?? 'user',
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $fields = [];
        $values = [];

        foreach (
            [
                'first_name',
                'last_name',
                'username',
                'email',
                'password',
                'role',
                'avatar',
                'membership'
            ] as $field
        ) {
            if (array_key_exists($field, $data)) {
                $fields[] = "{$field} = ?";
                $values[] = $data[$field];
            }
        }

        if (empty($fields)) {
            return false;
        }

        $values[] = $id;

        $sql = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = ?';

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($values);
    }

    public function setResetToken(int $id, string $token, string $expires): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE users
             SET reset_token = ?, reset_expires = ?
             WHERE id = ?'
        );

        return $stmt->execute([$token, $expires, $id]);
    }

    public function clearResetToken(int $id): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE users
             SET reset_token = NULL,
                 reset_expires = NULL
             WHERE id = ?'
        );

        return $stmt->execute([$id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            'DELETE FROM users WHERE id = ?'
        );

        return $stmt->execute([$id]);
    }

    public function count(): int
    {
        return (int) $this->db
            ->query('SELECT COUNT(*) FROM users')
            ->fetchColumn();
    }

    public function all(string $search = ''): array
    {
        if ($search) {

            $stmt = $this->db->prepare(
                'SELECT
                    id,
                    first_name,
                    last_name,
                    username,
                    email,
                    role,
                    created_at
                 FROM users
                 WHERE first_name LIKE ?
                    OR last_name LIKE ?
                    OR username LIKE ?
                    OR email LIKE ?
                 ORDER BY created_at DESC'
            );

            $term = '%' . $search . '%';

            $stmt->execute([
                $term,
                $term,
                $term,
                $term
            ]);
        } else {

            $stmt = $this->db->query(
                'SELECT
                    id,
                    first_name,
                    last_name,
                    username,
                    email,
                    role,
                    created_at
                 FROM users
                 ORDER BY created_at DESC'
            );
        }

        return $stmt->fetchAll();
    }

    public function getStats(int $userId): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT *
             FROM user_stats
             WHERE user_id = ?'
        );

        $stmt->execute([$userId]);

        $stats = $stmt->fetch();

        return $stats ?: null;
    }

    public function getReservations(int $userId): array
    {
        $stmt = $this->db->prepare(
            "SELECT
                r.*,
                a.title,
                a.image
             FROM reservations r
             INNER JOIN articles a
                ON a.id = r.article_id
             WHERE r.user_id = ?
             ORDER BY r.reservation_date ASC
             LIMIT 3"
        );

        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }
}
