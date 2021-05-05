<?php

declare(strict_types=1);

namespace App\GraphQL\Type\InputType;

use App\Enum\Genre;
use Symfony\Component\Validator\Constraints as Assert;

class CreateBandInput
{
    public function __construct(
        #[Assert\NotBlank] public string $name,
        #[Assert\GreaterThan(value: 'now')] public \DateTimeInterface $foundationDate,
        public Genre $genre
    ) {
    }
}