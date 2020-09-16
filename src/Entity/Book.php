<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 * @ORM\Table(name="books")
 */
class Book {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="text", unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="smallint")
     */
    private $year;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="books")
     */
    private $authors;

    public function __construct() {
        $this->authors = new ArrayCollection();
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): self {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?int {
        return $this->year;
    }

    public function setYear(int $year): self {
        $this->year = $year;

        return $this;
    }

    public function getImageUrl(): ?string {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $image_url): self {
        $this->imageUrl = $image_url;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAuthors(): Collection {
        return $this->authors;
    }

    public function addAuthors(User $authors): self {
        if (!$this->authors->contains($authors)) {
            $this->authors[] = $authors;
        }

        return $this;
    }

    public function removeAuthors(User $authors): self {
        if ($this->authors->contains($authors)) {
            $this->authors->removeElement($authors);
        }

        return $this;
    }
}
