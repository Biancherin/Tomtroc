<?php
class LibraryManager {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

public function getLastBooks(int $limit = 4): array {
    $limit = (int) $limit; // sécurité
    $sql = "
        SELECT 
            l.book_id,
            l.user_id,
            l.title,
            l.author,
            l.image,
            l.content,
            l.is_enabled,
            l.date_creation,
            l.date_update,
            u.nickname
        FROM library l
        JOIN user u ON l.user_id = u.user_id
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

public function getBookById(int $bookId): Library {
    $stmt = $this->pdo->prepare("
        SELECT 
            l.book_id,
            l.user_id,
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
        JOIN user u ON l.user_id = u.user_id
        WHERE l.book_id = :book_id
    ");
    $stmt->bindValue(':book_id', $bookId, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        throw new Exception("Livre introuvable !");
    }

    return new Library($row);
    }

    public function getAllBooksOrderedByDate(): array {
    $sql = "
        SELECT 
            l.book_id,
            l.user_id,
            l.title,
            l.author,
            l.image,
            l.content,
            l.is_enabled,
            l.date_creation,
            l.date_update,
            u.nickname
        FROM library l
        JOIN user u ON l.user_id = u.user_id
        ORDER BY l.date_creation DESC
    ";

    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

 