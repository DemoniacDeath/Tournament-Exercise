<?php
declare(strict_types=1);

namespace Tournament;

use MyCLabs\Enum\Enum;

/**
 * @method static self AXE
 * @method static self SWORD
 */
class DamageType extends Enum
{
    public const AXE = 1;
    public const SWORD = 2;

    public function isAxeDamage(): bool
    {
        return $this->equals(self::AXE());
    }

    public function isSwordDamage(): bool
    {
        return $this->equals(self::SWORD());
    }
}