<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;
use Tournament\DamageModifier;
use Tournament\Equipment\Defense\Armor;
use Tournament\Equipment\Defense\Defence;
use Tournament\Equipment\Equipment;
use Tournament\Fighter\AbstractFighter;
use Tournament\Fighter\Fighter;

abstract class AbstractWeapon implements Weapon
{
    /**
     * @var iterable|DamageModifier[]
     */
    protected iterable $damageModifiers = [];

    public function canAttack(): bool
    {
        return true;
    }

    public function addDamageModifier(DamageModifier $damageModifier): void
    {
        $this->damageModifiers[] = $damageModifier;
    }

    /**
     * @param Fighter $target
     * @param iterable|DamageModifier[] $damageModifiers
     */
    public function attack(Fighter $target, iterable $damageModifiers): void
    {
        if (!$this->canAttack()) {
            return;
        }
        $damage = $this->getDamage();
        foreach ($this->damageModifiers as $damageModifier) {
            $damage = $damageModifier->modifyDamage($damage);
        }
        foreach ($damageModifiers as $damageModifier) {
            $damage = $damageModifier->modifyDamage($damage);
        }

        $target->takeDamage($damage);
    }
}