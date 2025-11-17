<?php

/**
 * Entité User, un user est défini par les champs
 * user_t_id, email, password, nickname, image
 */

class User {
    private int $user_t_id;
    private string $email;
    private string $password;
    private string $nickname;
    private string $image;
    private ?DateTime $date_creation = null;

    public function __construct(array $data) {
        $this->user_t_id = $data['user_t_id'] ?? 0;
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->nickname = $data['nickname'] ?? '';
        $this->image = $data['image'] ?? null;
        $this->date_creation = isset($data['date_creation']) ? new DateTime($data['date_creation']) : null;
    }
   
    public function getUserTId(): int { return $this->user_t_id; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getNickname(): string { return $this->nickname; }
    public function getImage(): string { return $this->image; }
    public function getDatecreation(): ?DateTime { return $this->date_creation; }

    public function setUserTId(int $user_t_id): void { $this->user_t_id = $user_t_id; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function setNickname(string $nickname): void { $this->nickname = $nickname; }
    public function setImage(?string $image): void { $this->image = $image; }
    public function setDatecreation(): ?DateTime { return $this->date_creation; }

}
