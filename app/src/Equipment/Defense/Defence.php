<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Tournament\DamageModifier;
use Tournament\Equipment\Equipment;

abstract class Defence implements Equipment
{
    protected iterable $ownDamageModifiers = [];
    protected iterable $receivedDamageModifiers = [];

    /**
     * Defence constructor.
     * @param iterable|DamageModifier[] $ownDamageModifiers
     * @param iterable|DamageModifier[] $receivedDamageModifiers
     */
    public function __construct(iterable $ownDamageModifiers, iterable $receivedDamageModifiers)
    {
        $this->ownDamageModifiers = $ownDamageModifiers;
        $this->receivedDamageModifiers = $receivedDamageModifiers;
    }

    /**
     * @return iterable|DamageModifier[]
     */
    public function getOwnDamageModifiers(): iterable
    {
        return $this->ownDamageModifiers;
    }

    /**
     * @return iterable|DamageModifier[]
     */
    public function getReceivedDamageModifiers(): iterable
    {
        return $this->receivedDamageModifiers;
    }
}