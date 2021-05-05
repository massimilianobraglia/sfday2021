<?php

declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Entity\Band;
use TheCodingMachine\GraphQLite\Annotations as GQL;

#[GQL\Type(class: Band::class)]
#[GQL\SourceField(name: 'id', outputType: 'ID')]
#[GQL\SourceField(name: 'name')]
#[GQL\SourceField(name: 'foundationDate')]
#[GQL\SourceField(name: 'genre')]
class BandType
{
}