<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Equipment\Weapon\Axe;
use Tournament\Equipment\Weapon\Weapon;

class Viking extends Fighter
{
    public function initialHitPoints(): int
    {
        return 120;
    }

    public function initialWeapon(): Weapon
    {
        return new Axe();
    }
}