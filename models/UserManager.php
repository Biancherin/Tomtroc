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

    /** Récupérer un utilisateur par email et retourner un objet User */
    public function getUserByEmail(string $email): ?User {
        $stmt = $this->pdo->prepare("SELECT * FROM user_t WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    /** Récupérer un utilisateur par ID et retourner un objet User */
    public function getUserById(int $userId): ?User {
        $stmt = $this->pdo->prepare("SELECT * FROM user_t WHERE user_t_id = :id");
        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new User($data) : null;
    }

    /** Mettre à jour les informations d'un utilisateur
     *  L'image peut être optionnelle et stockée dans la table
     */
    public function updateUser(
        int $userId,
        string $nickname,
        string $email,
        ?string $passwordHash = null,
        ?string $image = null
    ): bool {
        $fields = ['nickname = :nickname', 'email = :email'];
        $params = [
            ':nickname' => $nickname,
            ':email' => $email,
            ':id' => $userId
        ];

        if ($passwordHash) {
            $fields[] = 'password = :password';
            $params[':password'] = $passwordHash;
        }

        if ($image) {
            $fields[] = 'image = :image';
            $params[':image'] = $image;
        }

        $sql = "UPDATE user_t SET " . implode(', ', $fields) . " WHERE user_t_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
