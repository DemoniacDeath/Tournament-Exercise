<?php
declare(strict_types=1);

namespace Tournament\DamageModifier;

use Tournament\DamageModifier;

abstract class AbstractDamageModifier implements DamageModifier
{
    public function combineWith(DamageModifier $otherDamageModifier): DamageModifier
    {
        return CollectionDamageModifier::combine($this, $otherDamageModifier);
    }
}