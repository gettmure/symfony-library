<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`users`")
 * @UniqueEntity(fields={"username"}, message="Аккаунт с таким именем уже существует!")
 */
class User extends BaseUser {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="id", type="guid", unique=true)
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, mappedBy="authors")
     */
    protected $books;

    public function __construct() {
        parent::__construct();
        $this->books = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection {
        return $this->books;
    }

    public function addBook(Book $book): self {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->addAuthors($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            $book->removeAuthors($this);
        }

        return $this;
    }

    public function __toString(): ?string {
        return $this->username;
    }
}