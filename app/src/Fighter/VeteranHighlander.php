<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Damage;

class VeteranHighlander extends Highlander
{
    public function isBerserk(): bool
    {
        return $this->hitPoints() < $this->initialHitPoints() * 0.3;
    }

    protected function calculateDamage(): Damage
    {
        $damage = parent::calculateDamage();
        if ($this->isBerserk()) {
            $damage = $damage->mul(2);
        }
        return $damage;
    }
}