<?php

declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Entity\Webzine;
use TheCodingMachine\GraphQLite\Annotations as GQL;

#[GQL\Type]
class WebzineType
{
    private Webzine $webzine;

    public function __construct(Webzine $webzine)
    {
        $this->webzine = $webzine;
    }

    /** The Webzine ID. */
    #[GQL\Field]
    public function getId(): int
    {
        return $this->webzine->getId();
    }

    /** The Webzine name. */
    #[GQL\Field]
    public function getName(): string
    {
        return $this->webzine->getName();
    }

    /** Another field not mapped.*/
    #[GQL\Field(name: 'anotherName')]
    public function getStaticStringField(): string
    {
        return 'This field is not mapped but I can select it';
    }
}