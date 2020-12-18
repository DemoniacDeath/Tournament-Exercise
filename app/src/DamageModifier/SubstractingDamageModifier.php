<?php
declare(strict_types=1);

namespace Tournament\DamageModifier;


use Tournament\Damage;
use Tournament\DamageModifier;

class SubstractingDamageModifier implements DamageModifier
{
    private int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function modifyDamage(Damage $damage): Damage
    {
        return $damage->sub($this->amount);
    }
}