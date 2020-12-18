<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Damage;
use Tournament\DamageModifier;

class BerserkDamageModifier implements DamageModifier
{
    public function modifyDamage(Damage $damage): Damage
    {
        return $damage->mul(2);
    }
}