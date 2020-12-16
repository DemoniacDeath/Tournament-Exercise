<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Damage;
use Tournament\Equipment\Defense\Defense;
use Tournament\Equipment\Equipment;
use Tournament\Equipment\Weapon\AbstractWeapon;
use Tournament\Equipment\Weapon\Weapon;

abstract class AbstractFighter implements Fighter
{
    protected int $hitPoints;
    protected Weapon $weapon;
    /**
     * @var iterable|Defense[]
     */
    protected iterable $defenses = [];

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
        $this->attack($fighter);
        $fighter->engage($this);
    }

    public function equip(Equipment $equipment): self
    {
        if ($equipment instanceof Weapon) {
            $this->weapon = $equipment;
        }
        if ($equipment instanceof Defense) {
            $this->defenses[] = $equipment;
        }
        return $this;
    }

    protected function isAlive(): bool
    {
        return $this->hitPoints > 0;
    }

    public function takeDamage(Damage $damage): void
    {
        foreach ($this->defenses as $defense) {
            $damage = $defense->reduceReceivedDamage($damage);
        }
        $this->hitPoints -= $damage->getAmount();
        if ($this->hitPoints < 0) {
            $this->hitPoints = 0;
        }
    }

    protected function attack(Fighter $fighter): void
    {
        $this->weapon->beforeAttack();
        if (!$this->weapon->canAttack()) {
            return;
        }
        $damage = $this->calculateDamage();
        $fighter->takeDamage($damage);
    }

    protected function calculateDamage(): Damage
    {
        $damage = $this->weapon->getDamage();
        foreach ($this->defenses as $defense) {
            $damage = $defense->reduceOwnDamage($damage);
        }
        return $damage;
    }
}