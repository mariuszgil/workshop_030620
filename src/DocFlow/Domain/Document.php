<?php

namespace DocFlow\Domain;

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
    private $title;

    /**
     * @var string
     */
    private $content;

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
        $this->number = $type . '/' . $clock->getDateTime()->format('Y/m/d');
    }

    public function verify(User $verifier): void
    {
        if (!$this->canBeVerified($this, $verifier)) {
            throw new \LogicException();
        }

        $this->status = DocumentStatus::VERIFIED();
        $this->verifier = $verifier;
    }

    public function publish(): void
    {

    }

    public function archive(): void
    {

    }

    public function addReader(User $reader)
    {

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

    private function canBeVerified(Document $document, User $verifier)
    {
        return !empty($document->getTitle()) &&
            !$document->getAuthor()->equals($verifier) &&
            $document->getStatus()->equals(DocumentStatus::DRAFT()); // kolejne warunki
    }
}