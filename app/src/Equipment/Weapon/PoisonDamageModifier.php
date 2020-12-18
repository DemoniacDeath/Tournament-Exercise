<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;
use Tournament\DamageModifier;

class PoisonDamageModifier implements DamageModifier
{
    private int $attackCounter = 0;

    public function modifyDamage(Damage $damage): Damage
    {
        $this->attackCounter++;
        if ($this->attackCounter <= 2) {
            return $damage->add(20);
        }
        return $damage;
    }
}