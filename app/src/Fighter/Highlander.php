<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Equipment\Weapon\GreatSword;
use Tournament\Equipment\Weapon\Weapon;

class Highlander extends Fighter
{
    public function initialHitPoints(): int
    {
        return 150;
    }

    public function initialWeapon(): Weapon
    {
        return new GreatSword();
    }
}