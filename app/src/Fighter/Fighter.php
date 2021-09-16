<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tournament\Damage;
use Tournament\DamageModifier;
use Tournament\DamageModifier\CollectionDamageModifier;
use Tournament\Equipment\Defense\Defence;
use Tournament\Equipment\Equipment;
use Tournament\Equipment\Weapon\Weapon;
use Tournament\Fighter\Strategy\DamageTaking\DamageTakingStrategy;
use Tournament\Fighter\Strategy\Equipment\WeaponStrategy;

abstract class Fighter
{
    private int $hitPoints;
    private Weapon $weapon;
    /**
     * @var Collection|Defence[]
     */
    private Collection $defences;
    private DamageModifier $damageModifier;
    private ?WeaponStrategy $weaponStrategy = null;
    private ?DamageTakingStrategy $damageTakingStrategy = null;

    /**
     * AbstractFighter constructor.
     */
    public function __construct()
    {
        $this->defences = new ArrayCollection();
        $this->damageModifier = new CollectionDamageModifier(new ArrayCollection());
        $this->hitPoints = $this->initialHitPoints();
        $this->equip($this->initialWeapon());
    }

    abstract public function initialHitPoints(): int;

    abstract public function initialWeapon(): Weapon;

    public function hitPoints(): int
    {
        return $this->hitPoints;
    }

    public function engage(Fighter $fighter): void
    {
        if ($this->hitPoints <= 0) {
            return;
        }
        $this->weapon->attack($fighter, $this->collectDamageModifiers());
        $fighter->engage($this);
    }

    public function equip(Equipment $equipment): self
    {
        if ($equipment instanceof Weapon) {
            if ($this->weaponStrategy !== null) {
                $equipment = $this->weaponStrategy->equippingWeapon($equipment);
            }
            $this->weapon = $equipment;
        }
        if ($equipment instanceof Defence) {
            $this->defences[] = $equipment;
        }
        return $this;
    }

    public function strategy(Strategy $strategy): Fighter
    {
        if ($strategy instanceof WeaponStrategy) {
            $this->weaponStrategy = $strategy;
            $this->weapon = $this->weaponStrategy->equippingWeapon($this->weapon);
        }
        if ($strategy instanceof DamageTakingStrategy) {
            $this->damageTakingStrategy = $strategy;
        }
        return $this;
    }

    public function takeDamage(Damage $damage): void
    {
        foreach ($this->defences as $defence) {
            $damage = $defence->modifyReceivedDamage($damage);
        }
        $this->hitPoints -= $damage->getAmount();
        if ($this->hitPoints < 0) {
            $this->hitPoints = 0;
        }
        if ($this->damageTakingStrategy !== null) {
            $this->damageTakingStrategy->damageTaken($damage, $this);
        }
    }

    public function addDamageModifier(DamageModifier $damageModifier): void
    {
        $this->damageModifier = $this->damageModifier->combineWith($damageModifier);
    }

    /**
     * @return DamageModifier
     */
    private function collectDamageModifiers(): DamageModifier
    {
        return (new CollectionDamageModifier(
            $this->defences->map(fn(Defence $defence) => $defence->getOwnDamageModifier())
        ))->combineWith($this->damageModifier);
    }
}