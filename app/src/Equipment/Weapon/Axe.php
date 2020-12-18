<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;
use Tournament\DamageType;

class Axe extends Weapon
{
    public function getDamage(): Damage
    {
        return new Damage(6, DamageType::AXE());
    }
}