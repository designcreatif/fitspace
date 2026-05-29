<?php

class Article
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT a.*, u.first_name AS author_first, u.last_name AS author_last
             FROM articles a
             LEFT JOIN users u ON a.author_id = u.id
             WHERE a.id = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function findPublished(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT a.*, u.first_name AS author_first, u.last_name AS author_last
             FROM articles a
             LEFT JOIN users u ON a.author_id = u.id
             WHERE a.id = ? AND a.status = "published"'
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function published(int $limit = 0): array
    {
        $sql = 'SELECT a.*, u.first_name AS author_first, u.last_name AS author_last
                FROM articles a
                LEFT JOIN users u ON a.author_id = u.id
                WHERE a.status = "published"
                ORDER BY a.published_at DESC';
        if ($limit > 0) {
            $sql .= ' LIMIT ' . (int) $limit;
        }
        return $this->db->query($sql)->fetchAll();
    }

    public function all(string $search = ''): array
    {
        if ($search) {
            $stmt = $this->db->prepare(
                'SELECT a.*, u.first_name AS author_first, u.last_name AS author_last
                 FROM articles a
                 LEFT JOIN users u ON a.author_id = u.id
                 WHERE a.title LIKE ? OR a.short_description LIKE ?
                 ORDER BY a.created_at DESC'
            );
            $term = '%' . $search . '%';
            $stmt->execute([$term, $term]);
        } else {
            $stmt = $this->db->query(
                'SELECT a.*, u.first_name AS author_first, u.last_name AS author_last
                 FROM articles a
                 LEFT JOIN users u ON a.author_id = u.id
                 ORDER BY a.created_at DESC'
            );
        }
        return $stmt->fetchAll();
    }

    public function count(): int
    {
        return (int) $this->db->query('SELECT COUNT(*) FROM articles')->fetchColumn();
    }

    public function countPublished(): int
    {
        return (int) $this->db->query('SELECT COUNT(*) FROM articles WHERE status = "published"')->fetchColumn();
    }

    public function slugExists(string $slug, ?int $excludeId = null): bool
    {
        $sql = 'SELECT COUNT(*) FROM articles WHERE slug = ?';
        $params = [$slug];
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
            'INSERT INTO articles (title, slug, short_description, full_description, image, author_id, status, published_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['short_description'],
            $data['full_description'],
            $data['image'] ?? null,
            $data['author_id'] ?? null,
            $data['status'] ?? 'published',
            $data['published_at'] ?? date('Y-m-d H:i:s'),
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $fields = [];
        $values = [];
        foreach (['title', 'slug', 'short_description', 'full_description', 'image', 'author_id', 'status', 'published_at'] as $field) {
            if (array_key_exists($field, $data)) {
                $fields[] = "{$field} = ?";
                $values[] = $data[$field];
            }
        }
        if (empty($fields)) {
            return false;
        }
        $values[] = $id;
        $sql = 'UPDATE articles SET ' . implode(', ', $fields) . ' WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    public function delete(int $id): bool
    {
        $article = $this->findById($id);
        if ($article && $article['image']) {
            $path = UPLOAD_PATH . $article['image'];
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $stmt = $this->db->prepare('DELETE FROM articles WHERE id = ?');
        return $stmt->execute([$id]);
    }
}

