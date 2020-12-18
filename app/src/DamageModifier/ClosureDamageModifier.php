<?php
declare(strict_types=1);

namespace Tournament\DamageModifier;


use Closure;
use Tournament\Damage;
use Tournament\DamageModifier;

class ClosureDamageModifier implements DamageModifier
{
    private Closure $closure;

    public function __construct(Closure $closure)
    {
        $this->closure = $closure;
    }

    public function modifyDamage(Damage $damage): Damage
    {
        return ($this->closure)($damage);
    }
}