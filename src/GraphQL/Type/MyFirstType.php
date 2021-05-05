<?php

declare(strict_types=1);

namespace App\GraphQL\Type;

use TheCodingMachine\GraphQLite\Annotations as GQL;

#[GQL\Type]
class MyFirstType
{
    #[GQL\Field]
    public function getDescription(): string
    {
        return 'I am the description';
    }
}