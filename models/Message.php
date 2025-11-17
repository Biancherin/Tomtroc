<?php

/**
 * Entité Message — un message échangé entre deux utilisateurs
 * Champs : message_id, sender_id, receiver_id, book_id, content, nickname, date_message, is_read
 */

class Message {
    private ?int $message_id;
    private ?int $sender_id;       // Utilisateur qui envoie
    private ?int $receiver_id;     // Utilisateur qui reçoit
    private ?int $book_id;
    private ?string $content;
    private ?string $nickname;
    private ?DateTime $date_message;
    private string $is_read ='1';

    public function __construct(array $data) {
        $this->message_id = $data['message_id'] ?? null;
        $this->sender_id = $data['sender_id'] ?? null;
        $this->receiver_id = $data['receiver_id'] ?? null;
        $this->book_id = $data['book_id'] ?? null;
        $this->content = $data['content'] ?? null;
        $this->nickname = $data['nickname'] ?? null;
        $this->date_message = isset($data['date_message']) ? new DateTime($data['date_message']) : null;
        $this->is_read = $data['is_read'] ?? '1';
    }

    // Getters
    public function getMessageId(): ?int { return $this->message_id; }
    public function getSenderId(): ?int { return $this->sender_id; }
    public function getReceiverId(): ?int { return $this->receiver_id; }
    public function getBookId(): ?int { return $this->book_id; }
    public function getContent(): ?string { return $this->content; }
    public function getNickname(): ?string { return $this->nickname; }
    public function getDateMessage(): ?DateTime { return $this->date_message; }
    public function getIsRead(): string { return $this->is_read; }

    // Setters
    public function setMessageId(?int $message_id): void { $this->message_id = $message_id; }
    public function setSenderId(?int $sender_id): void { $this->sender_id = $sender_id; }
    public function setReceiverId(?int $receiver_id): void { $this->receiver_id = $receiver_id; }
    public function setBookId(?int $book_id): void { $this->book_id = $book_id; }
    public function setContent(?string $content): void { $this->content = $content; }
    public function setNickname(?string $nickname): void { $this->nickname = $nickname; }
    public function setDateMessage(?string $date_message): void { $this->date_message = $date_message ? new DateTime($date_message) : null; }
    public function setIsRead(): string { return $this->is_read; }
}
