<?php
class LibraryManager {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /* ============================
       ✅ Derniers livres
       ============================ */
    public function getLastBooks(int $limit = 4): array {
        $limit = (int) $limit;

        $sql = "
            SELECT 
                l.book_id,
                l.user_t_id,
                l.title,
                l.author,
                l.image,
                l.content,
                l.is_enabled,
                l.date_creation,
                l.date_update,
                u.nickname
            FROM library l
            JOIN user_t u ON l.user_t_id = u.user_t_id
            ORDER BY l.date_creation DESC
            LIMIT $limit
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Library($row);
        }
        return $books;
    }

    /* ============================
       ✅ Livre par ID
       ============================ */
    public function getBookById(int $bookId): ?Library {
        $stmt = $this->pdo->prepare("
            SELECT 
                l.book_id,
                l.user_t_id,
                l.title,
                l.author,
                l.image,
                l.content,
                l.is_enabled,
                l.date_creation,
                l.date_update,
                u.nickname,
                u.image AS owner_image
            FROM library l
            JOIN user_t u ON l.user_t_id = u.user_t_id
            WHERE l.book_id = :book_id
        ");
        $stmt->bindValue(':book_id', $bookId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Library($row);
    }

    /* ============================
       ✅ Tous les livres triés
       ============================ */
    public function getAllBooksOrderedByDate(): array {
    $sql = "
        SELECT 
            l.book_id,
            l.user_t_id,
            l.title,
            l.author,
            l.image,
            l.content,
            l.is_enabled,
            l.date_creation,
            l.date_update,
            u.nickname,
            u.image AS owner_image
        FROM library l
        JOIN user_t u ON l.user_t_id = u.user_t_id
        ORDER BY l.date_creation DESC
    ";

    $stmt = $this->pdo->query($sql);

    $books = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $books[] = new Library($row);
    }

    return $books;
}


    /* ============================
       ✅ Livres d’un utilisateur
       ============================ */
    public function getBooksByUser(int $userId): array {
        $stmt = $this->pdo->prepare("
            SELECT 
                l.book_id,
                l.user_t_id,
                l.title,
                l.author,
                l.image,
                l.content,
                l.is_enabled,
                l.date_creation,
                l.date_update
            FROM library l
            WHERE l.user_t_id = :userId
            ORDER BY l.date_creation DESC
        ");

        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Library($row);
        }
        return $books;
    }

    /* ============================
       ✅ Recherche un lire
       ============================ */  
    public function searchBooks(string $keyword): array {
    $keyword = '%' . strtolower(trim($keyword)) . '%';

    $sql = "
        SELECT 
            l.book_id,
            l.user_t_id,
            l.title,
            l.author,
            l.image,
            l.content,
            l.is_enabled,
            l.date_creation,
            l.date_update,
            u.nickname,
            u.image AS owner_image
        FROM library l
        JOIN user_t u ON l.user_t_id = u.user_t_id
        WHERE LOWER(l.title) LIKE :keyword
           OR LOWER(l.author) LIKE :keyword
        ORDER BY l.date_creation DESC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':keyword' => $keyword]);

    $books = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $books[] = new Library($row);
    }

    return $books;
}


    /* ============================
       ✅ Ajouter un livre
       ============================ */
    public function addBook(array $data): bool {
        $sql = "
            INSERT INTO library (user_t_id, title, author, image, content, is_enabled)
            VALUES (:user_t_id, :title, :author, :image, :content, :is_enabled)
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':user_t_id'   => $data['user_t_id'],
            ':title'       => $data['title'],
            ':author'      => $data['author'],
            ':image'       => $data['image'] ?? null, // <-- image facultative
            ':content'     => $data['content'],
            ':is_enabled'  => $data['is_enabled'] ?? 1
        ]);
    }

    /* ============================
       ✅ Modifier un livre (texte)
       ============================ */
    public function updateBook(int $bookId, string $title, string $author, string $content, int $isEnabled): bool {
        $sql = "
            UPDATE library
            SET 
                title = :title,
                author = :author,
                content = :content,
                is_enabled = :is_enabled,
                date_update = NOW()
            WHERE book_id = :book_id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':book_id'     => $bookId,
            ':title'       => $title,
            ':author'      => $author,
            ':content'     => $content,
            ':is_enabled'  => $isEnabled
        ]);
    }

    /* ============================
       ✅ Modifier uniquement l’image
       ============================ */
    public function updateBookImage(int $bookId, string $imagePath): bool {
        $stmt = $this->pdo->prepare("
            UPDATE library
            SET image = :image, date_update = NOW()
            WHERE book_id = :book_id
        ");
        
        return $stmt->execute([
            ':image'   => $imagePath,
            ':book_id' => $bookId
        ]);
    }

    /* ============================
       ✅ Supprimer un livre
       ============================ */
    public function deleteBook(int $bookId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM library WHERE book_id = :book_id");
        $stmt->bindValue(':book_id', $bookId, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
