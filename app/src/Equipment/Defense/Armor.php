<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Tournament\Damage;

class Armor extends Defense
{
    public function reduceOwnDamage(Damage $damage): Damage
    {
        return $damage->sub(1);
    }

    public function reduceReceivedDamage(Damage $damage): Damage
    {
        return $damage->sub(3);
    }
}