<?php

namespace DocFlow\Domain;

use DocFlow\Domain\User\Suffixed;
use DocFlow\Domain\User\Uppercased;

class Document
{
    /**
     * @var string
     */
    private $number;

    /**
     * @var DocumentStatus
     */
    private $status;

    /**
     * @var DocumentType
     */
    private $type;

    /**
     * @var User
     */
    private $author;

    /**
     * @var User
     */
    private $verifier = null;

    /**
     * @var string
     */
    private $title = "";

    /**
     * @var string
     */
    private $content = "";

    /**
     * @var User[]
     */
    private $readers = [];

    /**
     * Document constructor.
     * @param DocumentType $type
     * @param User $author
     * @param Clock $clock
     */
    public function __construct(DocumentType $type, User $author, Clock $clock)
    {
        $this->type = $type;
        $this->author = $author;
        $this->status = DocumentStatus::DRAFT();
        $this->number = $type . '/' . $clock->getDateTime()->format('Y/m/d') . uniqid("", false);
        $this->readers[] = $author;
    }

    public function verify(User $verifier): void
    {
        if (!$this->canBeVerified($this, $verifier)) {
            throw new \LogicException();
        }

        $this->status = DocumentStatus::VERIFIED();
        $this->verifier = $verifier;
        $this->readers[] = $verifier;
    }

    public function publish(DocumentSigner $signer, EventPublisher $publisher): void
    {
        if (!$this->status->equals(DocumentStatus::VERIFIED())) {
            throw new \LogicException('...');
        }

        $signer->sign($this->author, $this->number);
        $publisher->publish(new Event());

        $this->status = DocumentStatus::PUBLISHED();
    }

    public function archive(): void
    {
        $this->status = DocumentStatus::ARCHIVED();
    }

    public function addReader(User $reader)
    {
        if (!$this->isOnReadersList($reader)) {
            $this->readers[] = $reader;
        }
    }

    public function changeContent(string $title, string $content): void
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * @return DocumentStatus
     */
    public function getStatus(): DocumentStatus
    {
        return $this->status;
    }

    /**
     * @return DocumentType
     */
    public function getType(): DocumentType
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @return User
     */
    public function getVerifier(): User
    {
        return $this->verifier;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getReaders(): array
    {
        $readers = [];

        foreach ($this->readers as $reader) {
            if ($reader->equals($this->author)) {
                $readers[] = new Suffixed(new Uppercased($reader), 'author');
            } elseif ($this->verifier && $reader->equals($this->verifier)) {
                $readers[] = new Suffixed(new Uppercased($reader), 'verifier');
            } else {
                $readers[] = $reader;
            }
        }

        return $readers;
    }

    private function canBeVerified(Document $document, User $verifier)
    {
        return !empty($document->getTitle()) &&
            !$document->getAuthor()->equals($verifier) &&
            $document->getStatus()->equals(DocumentStatus::DRAFT()); // kolejne warunki
    }

    public function isOnReadersList(User $reader): bool
    {
        return in_array($reader, $this->readers);
    }

    public function getReadersCount(): int
    {
        return count($this->readers);
    }
}