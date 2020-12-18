<?php
declare(strict_types=1);

namespace Tournament\Fighter\Strategy\DamageTaking;


use Tournament\Damage;
use Tournament\DamageModifier\BerserkDamageModifier;
use Tournament\Fighter\Fighter;

class Veteran implements DamageTakingStrategy
{
    private bool $alreadyBerserk = false;

    public function damageTaken(Damage $damage, Fighter $fighter): void
    {
        if (!$this->alreadyBerserk && $fighter->hitPoints() < 0.3 * $fighter->initialHitPoints()) {
            $fighter->addDamageModifier(new BerserkDamageModifier());
            $this->alreadyBerserk = true;
        }
    }
}