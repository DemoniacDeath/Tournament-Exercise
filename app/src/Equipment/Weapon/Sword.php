<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;
use Tournament\DamageType;

class Sword extends Weapon
{
    public function getDamage(): Damage
    {
        return new Damage(5, DamageType::SWORD());
    }
}