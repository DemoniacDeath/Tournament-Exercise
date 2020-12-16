<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;
use Tournament\Equipment\Defense\Armor;
use Tournament\Equipment\Defense\Defense;
use Tournament\Equipment\Equipment;
use Tournament\Fighter\AbstractFighter;

abstract class AbstractWeapon implements Weapon
{
    public function canAttack(): bool
    {
        return true;
    }

    public function beforeAttack(): void
    {
    }
}