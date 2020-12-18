<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;
use Tournament\DamageModifier;
use Tournament\DamageType;
use Tournament\Fighter\Fighter;

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

    /**
     * @param Fighter $target
     * @param iterable|DamageModifier[] $damageModifiers
     */
    public function attack(Fighter $target, iterable $damageModifiers): void
    {
        $this->attackCounter++;
        parent::attack($target, $damageModifiers);
    }
}