<?php

/**
 * Entité library, un book est défini par les champs
 * book_id, user_t_id, title, author, image, content, statut, date_creation, date_update
 */

class Library {
    private int $book_id;
    private int $user_t_id;
    private string $title;
    private string $author;
    private string $image;
    private string $content;
    private string $is_enabled ='1';
    private ?DateTime $date_creation = null;
    private ?DateTime $date_update = null;
    private ?string $nickname = null;
    private ?string $owner_image;

    public function __construct(array $data) {
        $this->book_id = $data['book_id'];
        $this->user_t_id = $data['user_t_id'];
        $this->title = $data['title'];
        $this->author = $data['author'];
        $this->image = $data['image'];
        $this->content = $data['content'];
        $this->is_enabled = $data['is_enabled'] ?? '1';
        $this->date_creation = isset($data['date_creation']) ? new DateTime($data['date_creation']) : null;
        $this->date_update = isset($data['date_update']) ? new DateTime($data['date_update']) : null;
        $this->nickname = $data['nickname'] ?? null;
        $this->owner_image = $data['owner_image'] ?? null;
    }

    public function getBookId(): int { return $this->book_id; }
    public function getUserTId(): int { return $this->user_t_id; }
    public function getTitle(): string { return $this->title; }
    public function getAuthor(): string { return $this->author; }
    public function getImage(): string { return $this->image; }
    public function getContent(): string { return $this->content; }
    public function getIsEnabled(): string { return $this->is_enabled; }
    public function getDatecreation(): ?DateTime { return $this->date_creation; }
    public function getDateupdate(): ?DateTime { return $this->date_update; }
    public function getNickname(): ?string { return $this->nickname; }
    public function getOwnerImage(): ?string { return $this->owner_image; }
}
