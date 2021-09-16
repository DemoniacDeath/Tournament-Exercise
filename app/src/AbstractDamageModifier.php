<?php
declare(strict_types=1);

namespace Tournament;

use Tournament\DamageModifier\CollectionDamageModifier;

abstract class AbstractDamageModifier implements DamageModifier
{
    public function combineWith(DamageModifier $otherDamageModifier): DamageModifier
    {
        return CollectionDamageModifier::combine($this, $otherDamageModifier);
    }
}