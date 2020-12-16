<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Tournament\Damage;
use Tournament\Equipment\Equipment;

abstract class Defense implements Equipment
{
    public function reduceOwnDamage(Damage $damage): Damage
    {
        return $damage;
    }

    public function reduceReceivedDamage(Damage $damage): Damage
    {
        return $damage;
    }
}