<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Equipment\Weapon\Sword;
use Tournament\Equipment\Weapon\Weapon;

class Swordsman extends Fighter
{
    public function initialHitPoints(): int
    {
        return 100;
    }

    public function initialWeapon(): Weapon
    {
        return new Sword();
    }
}
