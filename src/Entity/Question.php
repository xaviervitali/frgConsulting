<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 * @ApiResource
 */

class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"question:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max = 100, maxMessage = "Your title cannot be longer than {{ limit }} characters")
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     * @Assert\NotNull
      * @Groups({"question:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull
     * @Assert\Type(type="bool", message="The value {{ value }} is not a valid {{ type }}.")
     * @Groups({"question:read"})
     */
    private $promoted;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice({"draft", "published"}, message="Choose a valid status (draft or published).")
     * @Assert\NotNull
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     * @Groups({"question:read"})
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="question")
      * @Groups({"question:read"})
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity=HistoricQuestion::class, mappedBy="question")
      * @Groups({"question:read"})
     */
    private $historicQuestions;
    /**
     * @ORM\Column(type="datetime")
      * @Groups({"question:read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
      * @Groups({"question:read"})
     */
    private $updatedAt;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->historicQuestions =  new ArrayCollection();
    }

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

    public function getPromoted(): ?bool
    {
        return $this->promoted;
    }

    public function setPromoted(bool $promoted): self
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

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

     /**
     * @return Collection|HistoricQuestion[]
     */
    public function getHistoricQuestions(): Collection
    {
        return $this->historicQuestions;
    }

    public function addHistoricQuestions(HistoricQuestion $historicQuestions): self
    {
        if (!$this->historicQuestions->contains($historicQuestions)) {
            $this->historicQuestions[] = $historicQuestions;
            $historicQuestions->setQuestion($this);
        }

        return $this;
    }

    public function removeHistoricQuestions(HistoricQuestion $historicQuestions): self
    {
        if ($this->historicQuestions->removeElement($historicQuestions)) {
            // set the owning side to null (unless already changed)
            if ($historicQuestions->getQuestion() === $this) {
                $historicQuestions->setQuestion(null);
            }
        }

        return $this;
    }


    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
