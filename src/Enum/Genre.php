<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static static POP();
 */
class Genre extends Enum
{
    private const POP = 'POP';
    private const ROCK = 'ROCK';
    private const HEAVY_METAL = 'HEAVY_METAL';
    private const CLASSICAL = 'CLASSICAL';
    private const RAP = 'RAP';
}