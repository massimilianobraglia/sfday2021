<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlbumRepository::class)
 */
class Album
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Band::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Band $band;

    /** @ORM\Column(type="string") */
    private string $name;

    public function __construct(Band $band, string $name)
    {
        $this->id = \random_int(0, 10000);
        $this->band = $band;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBand(): Band
    {
        return $this->band;
    }

    public function getName(): string
    {
        return $this->name;
    }
}