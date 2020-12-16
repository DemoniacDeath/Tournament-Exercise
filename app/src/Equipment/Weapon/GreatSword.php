<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;
use Tournament\DamageType;

class GreatSword extends AbstractWeapon
{
    private int $attackCounter = 0;

    public function getDamage(): Damage
    {
        return new Damage(
            12,
            DamageType::SWORD()
        );
    }

    public function canAttack(): bool
    {
        return $this->attackCounter % 3 !== 0;
    }

    public function beforeAttack(): void
    {
        $this->attackCounter++;
    }
}