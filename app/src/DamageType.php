<?php
declare(strict_types=1);

namespace Tournament;

use MyCLabs\Enum\Enum;

/**
 * Class DamageType
 * @package Tournament\Equipment\Weapon
 * @method static self AXE
 * @method static self SWORD
 */
class DamageType extends Enum
{
    public const AXE = 1;
    public const SWORD = 2;
}