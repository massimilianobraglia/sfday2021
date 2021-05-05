<?php

declare(strict_types=1);

namespace App\GraphQL\Type\InputType;

use App\Enum\Genre;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateBandInput
{
    public function __construct(
        public int $id,
        #[Assert\Regex(pattern: '/^([a-z][0-9][A-Z])+$/', message: 'The value must match ^([a-z][0-9][A-Z])+$')] public ?string $name,
        #[Assert\LessThan(value: 'now')] public ?\DateTimeInterface $foundationDate,
        public ?Genre $genre
    ) {
    }
}