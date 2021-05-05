<?php

declare(strict_types=1);

namespace App\GraphQL\Type\InputType;

use App\Enum\Genre;
use TheCodingMachine\GraphQLite\Annotations as GQL;

class BandInputFactory
{
    #[GQL\Factory(name: 'CreateBandInput', default: true)]
    public static function createBandInput(
        string $name,
        \DateTimeInterface $foundationDate,
        Genre $genre
    ): CreateBandInput {
        return new CreateBandInput($name, $foundationDate, $genre);
    }

    #[GQL\Factory(name: 'UpdateBandInput', default: true)]
    public function updateBandInput(
        int $id,
        ?string $name,
        ?\DateTimeInterface $foundationDate,
        ?Genre $genre
    ): UpdateBandInput
    {
        return new UpdateBandInput($id, $name, $foundationDate, $genre);
    }
}