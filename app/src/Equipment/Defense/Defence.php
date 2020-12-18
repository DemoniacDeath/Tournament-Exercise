<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Doctrine\Common\Collections\Collection;
use Tournament\DamageModifier;
use Tournament\DamageModifier\CollectionDamageModifier;
use Tournament\Equipment\Equipment;

abstract class Defence implements Equipment
{
    protected Collection $ownDamageModifiers;
    protected Collection $receivedDamageModifiers;

    /**
     * Defence constructor.
     * @param Collection|DamageModifier[] $ownDamageModifiers
     * @param Collection|DamageModifier[] $receivedDamageModifiers
     */
    public function __construct(Collection $ownDamageModifiers, Collection $receivedDamageModifiers)
    {
        $this->ownDamageModifiers = $ownDamageModifiers;
        $this->receivedDamageModifiers = $receivedDamageModifiers;
    }

    /**
     * @return DamageModifier
     */
    public function getOwnDamageModifier(): DamageModifier
    {
        return new CollectionDamageModifier($this->ownDamageModifiers);
    }

    /**
     * @return DamageModifier
     */
    public function getReceivedDamageModifier(): DamageModifier
    {
        return new CollectionDamageModifier($this->receivedDamageModifiers);
    }
}