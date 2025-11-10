<?php
class UserManager {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /** Ajouter un nouvel utilisateur */
    public function addUser(string $nickname, string $email, string $passwordHash): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO user_t (nickname, email, password)
            VALUES (:nickname, :email, :password)
        ");
        return $stmt->execute([
            ':nickname' => $nickname,
            ':email' => $email,
            ':password' => $passwordHash
        ]);
    }

    /** Récupérer un utilisateur par email */
    public function getUserByEmail(string $email): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM user_t WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    /** Récupérer un utilisateur par ID */
    public function getUserById(int $userId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM user_t WHERE user_t_id = :id");
        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    /** Mettre à jour les informations d'un utilisateur */
    public function updateUser(int $userId, string $nickname, string $email, ?string $passwordHash = null): bool {
        if ($passwordHash) {
            $stmt = $this->pdo->prepare("
                UPDATE user_t
                SET nickname = :nickname,
                    email = :email,
                    password = :password
                WHERE user_t_id = :id
            ");
            return $stmt->execute([
                ':nickname' => $nickname,
                ':email' => $email,
                ':password' => $passwordHash,
                ':id' => $userId
            ]);
        } else {
            $stmt = $this->pdo->prepare("
                UPDATE user_t
                SET nickname = :nickname,
                    email = :email
                WHERE user_t_id = :id
            ");
            return $stmt->execute([
                ':nickname' => $nickname,
                ':email' => $email,
                ':id' => $userId
            ]);
        }
    }
}

