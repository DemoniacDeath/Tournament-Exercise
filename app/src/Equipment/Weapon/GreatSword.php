<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;
use Tournament\DamageModifier;
use Tournament\DamageType;
use Tournament\Fighter\Fighter;

class GreatSword extends Weapon
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

    /**
     * @param Fighter $target
     * @param DamageModifier $wielderDamageModifier
     */
    public function attack(Fighter $target, DamageModifier $wielderDamageModifier): void
    {
        $this->attackCounter++;
        parent::attack($target, $wielderDamageModifier);
    }
}