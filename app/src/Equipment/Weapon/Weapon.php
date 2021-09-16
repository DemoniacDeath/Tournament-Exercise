<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Doctrine\Common\Collections\ArrayCollection;
use Tournament\Damage;
use Tournament\DamageModifier;
use Tournament\DamageModifier\CollectionDamageModifier;
use Tournament\DamageModifier\DummyDamageModifier;
use Tournament\Equipment\Equipment;
use Tournament\Fighter\Fighter;

abstract class Weapon implements Equipment
{
    /**
     * @var CollectionDamageModifier
     */
    private $damageModifier;

    /**
     * AbstractWeapon constructor.
     */
    public function __construct()
    {
        $this->damageModifier = new DummyDamageModifier();
    }

    public function canAttack(): bool
    {
        return true;
    }

    public function addDamageModifier(DamageModifier $damageModifier): self
    {
        $this->damageModifier = $this->damageModifier->combineWith($damageModifier);
        return $this;
    }

    /**
     * @param Fighter $target
     * @param DamageModifier $wielderDamageModifier
     */
    public function attack(Fighter $target, DamageModifier $wielderDamageModifier): void
    {
        if (!$this->canAttack()) {
            return;
        }
        $target->takeDamage(
            $wielderDamageModifier
                ->combineWith($this->getOwnDamageModifier())
                ->modifyDamage($this->getDamage())
        );
    }

    public function getOwnDamageModifier(): DamageModifier
    {
        return $this->damageModifier;
    }

    abstract public function getDamage(): Damage;
}