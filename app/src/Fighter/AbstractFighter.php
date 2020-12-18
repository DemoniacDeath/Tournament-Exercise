<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Damage;
use Tournament\DamageModifier;
use Tournament\Equipment\Defense\Defence;
use Tournament\Equipment\Equipment;
use Tournament\Equipment\Weapon\AbstractWeapon;
use Tournament\Equipment\Weapon\Weapon;

abstract class AbstractFighter implements Fighter
{
    protected int $hitPoints;
    protected Weapon $weapon;
    /**
     * @var iterable|Defence[]
     */
    protected iterable $defences = [];
    /**
     * @var iterable|DamageModifier[]
     */
    protected iterable $damageModifiers = [];

    /**
     * AbstractFighter constructor.
     */
    public function __construct()
    {
        $this->hitPoints = $this->initialHitPoints();
    }

    public function hitPoints(): int
    {
        return $this->hitPoints;
    }

    public function engage(Fighter $fighter): void
    {
        if (!$this->isAlive()) {
            return;
        }
        $this->weapon->attack($fighter, $this->collectDamageModifiers());
        $fighter->engage($this);
    }

    public function equip(Equipment $equipment): self
    {
        if ($equipment instanceof Weapon) {
            $this->weapon = $equipment;
        }
        if ($equipment instanceof Defence) {
            $this->defences[] = $equipment;
        }
        return $this;
    }

    protected function isAlive(): bool
    {
        return $this->hitPoints > 0;
    }

    public function takeDamage(Damage $damage): void
    {
        foreach ($this->defences as $defence) {
            foreach ($defence->getReceivedDamageModifiers() as $damageModifier) {
                $damage = $damageModifier->modifyDamage($damage);
            }
        }
        $this->hitPoints -= $damage->getAmount();
        if ($this->hitPoints < 0) {
            $this->hitPoints = 0;
        }
    }

    public function defences(): iterable
    {
        return $this->defences;
    }

    public function modifyDamage(Damage $damage): Damage
    {
        foreach ($this->defences as $defense) {
            $damage = $defense->reduceOwnDamage($damage);
        }
        return $damage;
    }

    /**
     * @return iterable|DamageModifier[]
     */
    protected function collectDamageModifiers(): iterable
    {
        $damageModifiers = [];
        foreach ($this->defences as $defense) {
            foreach ($defense->getOwnDamageModifiers() as $damageModifier) {
                $damageModifiers[] = $damageModifier;
            }
        }
        foreach ($this->damageModifiers as $damageModifier) {
            $damageModifiers[] = $damageModifier;
        }
        return $damageModifiers;
    }
}