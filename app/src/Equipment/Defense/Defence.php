<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Tournament\Damage;
use Tournament\DamageModifier;
use Tournament\DamageModifier\DummyDamageModifier;
use Tournament\Equipment\Equipment;

abstract class Defence implements Equipment
{
    private ?DamageModifier $ownDamageModifier;
    private ?DamageModifier $receivedDamageModifier;

    /**
     * @param DamageModifier|null $ownDamageModifier
     * @param DamageModifier|null $receivedDamageModifier
     */
    public function __construct(DamageModifier $receivedDamageModifier = null, DamageModifier $ownDamageModifier = null)
    {
        $this->receivedDamageModifier = $receivedDamageModifier;
        $this->ownDamageModifier = $ownDamageModifier;
    }

    public function getOwnDamageModifier(): DamageModifier
    {
        return $this->ownDamageModifier ?? new DummyDamageModifier();
    }

    public function getReceivedDamageModifier(): DamageModifier
    {
        return $this->receivedDamageModifier ?? new DummyDamageModifier();
    }

    public function modifyReceivedDamage(Damage $damage): Damage
    {
        return $this->getReceivedDamageModifier()->modifyDamage($damage);
    }
}