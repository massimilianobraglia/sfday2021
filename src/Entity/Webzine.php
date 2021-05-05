<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\WebzineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WebzineRepository::class)
 */
class Webzine
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private int $id;

    /** @ORM\Column(type="string") */
    private string $name;

    public function __construct(string $name)
    {
        $this->id = \random_int(0, 10000);
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}