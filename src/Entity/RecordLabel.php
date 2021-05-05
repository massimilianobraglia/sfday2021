<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RecordLabelRepository;
use Doctrine\ORM\Mapping as ORM;
use TheCodingMachine\GraphQLite\Annotations as GQL;

/**
 * @ORM\Entity(repositoryClass=RecordLabelRepository::class)
 */
#[GQL\Type(name: 'RecordLabelType')]
class RecordLabel
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

    #[GQL\Field(outputType: 'ID')]
    public function getId(): int
    {
        return $this->id;
    }

    #[GQL\Field]
    public function getName(): string
    {
        return $this->name;
    }
}