<?php
declare(strict_types=1);

namespace Tournament\DamageModifier;


use Tournament\Damage;

class BerserkDamageModifier extends ClosureDamageModifier
{
    public function __construct()
    {
        parent::__construct(fn(Damage $damage) => $damage->mul(2));
    }
}