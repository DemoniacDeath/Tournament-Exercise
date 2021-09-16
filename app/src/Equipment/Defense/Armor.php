<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Tournament\Damage;
use Tournament\DamageModifier\ClosureDamageModifier;

class Armor extends Defence
{
    public function __construct()
    {
        parent::__construct(
            new ClosureDamageModifier(fn(Damage $damage) => $damage->sub(3)),
            new ClosureDamageModifier(fn(Damage $damage) => $damage->sub(1)),
        );
    }
}