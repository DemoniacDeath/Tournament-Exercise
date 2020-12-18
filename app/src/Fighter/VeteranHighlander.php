<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Damage;

class VeteranHighlander extends Highlander
{
    public function takeDamage(Damage $damage): void
    {
        parent::takeDamage($damage);
        if ($this->isBerserk() && !$this->hasBerserkDamageModifier()) {
            $this->damageModifiers[] = new BerserkDamageModifier();
        }
    }

    protected function isBerserk(): bool
    {
        return $this->hitPoints() < $this->initialHitPoints() * 0.3;
    }

    protected function hasBerserkDamageModifier(): bool
    {
        foreach ($this->damageModifiers as $damageModifier) {
            if ($damageModifier instanceof BerserkDamageModifier) {
                return true;
            }
        }
        return false;
    }
}