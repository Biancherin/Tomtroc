<?php
class MessageManager {
    private PDO $pdo;

    public function __construct(PDO $dbConnection) {
        $this->pdo = $dbConnection;
    }

    /**
     * 🔹 Récupère la conversation entre deux utilisateurs
     */
    public function getConversation(int $user1, int $user2): array {
        $sql = "
            SELECT * FROM message 
            WHERE 
                (sender_id = :user1 AND receiver_id = :user2)
             OR (sender_id = :user2 AND receiver_id = :user1)
            ORDER BY date_message ASC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user1' => $user1,
            ':user2' => $user2
        ]);

        $messages = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new Message($row);
        }

        return $messages;
    }

    /**
     * 🔹 Envoie un message entre deux utilisateurs
     */
    public function sendMessage(int $sender_id, int $receiver_id, ?int $book_id, string $content, string $nickname): bool {
        $sql = "
            INSERT INTO message (sender_id, receiver_id, book_id, content, nickname, date_message, is_read)
            VALUES (:sender_id, :receiver_id, :book_id, :content, :nickname, NOW(), :is_read)
        ";
        $stmt = $this->pdo->prepare($sql);

        // book_id : NULL si aucun livre
        $book_id_param = $book_id > 0 ? $book_id : null;

        return $stmt->execute([
            ':sender_id' => $sender_id,
            ':receiver_id' => $receiver_id,
            ':book_id' => $book_id_param,
            ':content' => $content,
            ':nickname' => $nickname,
            ':is_read' => 0  // par défaut, message non lu
        ]);
    }

    /**
     * 🔹 Récupère la liste des dernières conversations d’un utilisateur
     */
    public function getUserConversations(int $userId): array {
        $sql = "
            SELECT 
                CASE 
                    WHEN sender_id = :userId THEN receiver_id 
                    ELSE sender_id 
                END AS contact_id,
                MAX(date_message) AS last_date,
                SUBSTRING_INDEX(MAX(CONCAT(date_message, ':', content)), ':', -1) AS last_message,
                u.nickname AS nickname,
                u.image AS image
            FROM message m
            JOIN user_t u ON u.user_t_id = 
                CASE 
                    WHEN m.sender_id = :userId THEN m.receiver_id 
                    ELSE m.sender_id 
                END
            WHERE m.sender_id = :userId OR m.receiver_id = :userId
            GROUP BY contact_id
            ORDER BY last_date DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 🔹 Supprime tous les messages liés à un utilisateur
     */
    public function deleteMessagesByUser(int $userId): bool {
        $sql = "DELETE FROM message WHERE sender_id = :user OR receiver_id = :user";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':user' => $userId]);
    }

    /**
     * 🔹 Compte les messages non lus pour un utilisateur
     */
    public function getUnreadCount(int $userId): int {
        $sql = "
            SELECT COUNT(*)
            FROM message
            WHERE receiver_id = :uid
            AND is_read = 0
        ";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':uid' => $userId]);

        return (int) $stmt->fetchColumn();
    }

    /**
     * 🔹 Marque un message comme lu
     */
    public function markMessageAsRead(int $messageId, int $userId): void {
        $sql = "
            UPDATE message
            SET is_read = 1
            WHERE message_id = :mid
            AND receiver_id = :uid
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':mid' => $messageId,
            ':uid' => $userId
        ]);
    }
}
