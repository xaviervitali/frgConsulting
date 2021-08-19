<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 * @ApiResource
 */

class HistoricQuestion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"question:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)

     * @Groups({"question:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"question:read"})
     *      */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"question:read"})
     */
    private $promoted;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"question:read"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="historicQuestions")
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPromoted(): ?string
    {
        return $this->promoted;
    }

    public function setPromoted(string $promoted): self
    {
        $this->promoted = $promoted;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {

        $this->question = $question;

        return $this;
    }
}
