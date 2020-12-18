<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;
use Tournament\DamageModifier;
use Tournament\Equipment\Equipment;
use Tournament\Fighter\Fighter;

interface Weapon extends Equipment
{
    public function getDamage(): Damage;

    public function canAttack(): bool;

    /**
     * @param Fighter $target
     * @param iterable|DamageModifier[] $damageModifiers
     */
    public function attack(Fighter $target, iterable $damageModifiers): void;

    public function addDamageModifier(DamageModifier $damageModifier): void;
}