<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Tournament\Damage;
use Tournament\DamageType;

class Buckler extends Defense
{
    protected bool $isDestroyed = false;
    protected int $hitsReceived = 0;
    protected int $hitsBlockedByAxe = 0;

    public function reduceReceivedDamage(Damage $damage): Damage
    {
        $this->hitsReceived++;
        if ($this->shouldBlock()) {
            $damage = $damage->zero();
            $this->blocked($damage->getType());
        }
        return $damage;
    }

    protected function shouldBlock(): bool
    {
        if ($this->isDestroyed) {
            return false;
        }
        return $this->hitsReceived % 2 !== 0;
    }

    protected function blocked(DamageType $damageType): void
    {
        if ($damageType->equals(DamageType::AXE())) {
            $this->hitsBlockedByAxe++;
            if ($this->hitsBlockedByAxe >= 3) {
                $this->isDestroyed = true;
            }
        }
    }
}