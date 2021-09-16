<?php
declare(strict_types=1);

namespace Tournament\DamageModifier;


use Tournament\Damage;

class PoisonDamageModifier extends AbstractDamageModifier
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