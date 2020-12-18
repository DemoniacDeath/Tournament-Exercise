<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Doctrine\Common\Collections\Collection;
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
     * @param Collection|DamageModifier[] $wielderDamageModifiers
     */
    public function attack(Fighter $target, Collection $wielderDamageModifiers): void;

    public function addDamageModifier(DamageModifier $damageModifier): void;
}