<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tournament\Damage;
use Tournament\DamageModifier;
use Tournament\Equipment\Defense\Defence;
use Tournament\Equipment\Equipment;
use Tournament\Equipment\Weapon\Weapon;
use Tournament\Fighter\Strategy\DamageTaking\DamageTakingStrategy;
use Tournament\Fighter\Strategy\Equipment\EquipmentStrategy;

abstract class AbstractFighter implements Fighter
{
    protected int $hitPoints;
    protected Weapon $weapon;
    /**
     * @var Collection|Defence[]
     */
    protected Collection $defences;
    /**
     * @var Collection|DamageModifier[]
     */
    protected Collection $damageModifiers;
    /**
     * @var Collection|EquipmentStrategy[]
     */
    protected Collection $equipmentStrategies;
    /**
     * @var Collection|DamageTakingStrategy[]
     */
    protected Collection $damageTakingStrategies;

    /**
     * AbstractFighter constructor.
     */
    public function __construct()
    {
        $this->hitPoints = $this->initialHitPoints();
        $this->defences = new ArrayCollection();
        $this->damageModifiers = new ArrayCollection();
        $this->equipmentStrategies = new ArrayCollection();
        $this->damageTakingStrategies = new ArrayCollection();
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
            $equipment = array_reduce(
                $this->equipmentStrategies->toArray(),
                fn(Weapon $weapon, EquipmentStrategy $equipmentStrategy) => $equipmentStrategy->equippingWeapon($weapon),
                $equipment
            );
            $this->weapon = $equipment;
        }
        if ($equipment instanceof Defence) {
            $equipment = array_reduce(
                $this->equipmentStrategies->toArray(),
                fn(Defence $defence, EquipmentStrategy $equipmentStrategy) => $equipmentStrategy->equippingDefence($defence),
                $equipment
            );
            $this->defences[] = $equipment;
        }
        return $this;
    }

    public function strategy(Strategy $strategy): Fighter
    {
        if ($strategy instanceof EquipmentStrategy) {
            $this->equipmentStrategies->add($strategy);
        }
        if ($strategy instanceof DamageTakingStrategy) {
            $this->damageTakingStrategies->add($strategy);
        }
        return $this;
    }

    public function takeDamage(Damage $damage): void
    {
        foreach ($this->defences as $defence) {
            $damage = $defence->getReceivedDamageModifier()->modifyDamage($damage);
        }
        $this->hitPoints -= $damage->getAmount();
        if ($this->hitPoints < 0) {
            $this->hitPoints = 0;
        }
        foreach ($this->damageTakingStrategies as $damageTakingStrategy) {
            $damageTakingStrategy->damageTaken($damage, $this);
        }
    }

    public function addDamageModifier(DamageModifier $damageModifier): void
    {
        $this->damageModifiers->add($damageModifier);
    }

    protected function isAlive(): bool
    {
        return $this->hitPoints > 0;
    }

    /**
     * @return iterable|DamageModifier[]
     */
    protected function collectDamageModifiers(): iterable
    {
        $damageModifiers = [];
        foreach ($this->defences as $defence) {
            $damageModifiers[] = $defence->getOwnDamageModifier();
        }
        foreach ($this->damageModifiers as $damageModifier) {
            $damageModifiers[] = $damageModifier;
        }
        return $damageModifiers;
    }
}