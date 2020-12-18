<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tournament\DamageModifier;
use Tournament\Equipment\Equipment;
use Tournament\Fighter\Fighter;

abstract class Weapon implements Equipment
{
    /**
     * @var Collection|DamageModifier[]
     */
    protected Collection $damageModifiers;

    /**
     * AbstractWeapon constructor.
     */
    public function __construct()
    {
        $this->damageModifiers = new ArrayCollection();
    }

    public function canAttack(): bool
    {
        return true;
    }

    public function addDamageModifier(DamageModifier $damageModifier): self
    {
        $this->damageModifiers[] = $damageModifier;
        return $this;
    }

    /**
     * @param Fighter $target
     * @param Collection|DamageModifier[] $wielderDamageModifiers
     */
    public function attack(Fighter $target, Collection $wielderDamageModifiers): void
    {
        if (!$this->canAttack()) {
            return;
        }
        $damage = $this->getDamage();
        foreach ($this->damageModifiers as $damageModifier) {
            $damage = $damageModifier->modifyDamage($damage);
        }
        foreach ($wielderDamageModifiers as $damageModifier) {
            $damage = $damageModifier->modifyDamage($damage);
        }

        $target->takeDamage($damage);
    }
}