<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Genre;
use App\Repository\BandRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BandRepository::class)
 */
class Band
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private int $id;

    /** @ORM\Column(type="string") */
    private string $name;

    /** @ORM\Column(type="datetime_immutable") */
    private \DateTimeInterface $foundationDate;

    /** @ORM\Column(type="string") */
    private string $genre;

    public function __construct(string $description, \DateTimeInterface $foundationDate, Genre $genre)
    {
        $this->id = \random_int(0, 10000);
        $this->name = $description;
        $this->foundationDate = $foundationDate;
        $this->genre = (string) $genre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function updateName(string $name): void
    {
        $this->name = $name;
    }

    public function getFoundationDate(): \DateTimeInterface
    {
        return $this->foundationDate;
    }

    public function updateFoundationDate(\DateTimeInterface $foundationDate): void
    {
        $this->foundationDate = $foundationDate;
    }

    public function getGenre(): Genre
    {
        return new Genre($this->genre);
    }

    public function updateGenre(Genre $genre): void
    {
        $this->genre = (string) $genre;
    }
}