<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Tournament\DamageModifier\SubstractingDamageModifier;

class Armor extends Defence
{
    public function __construct()
    {
        parent::__construct([
            new SubstractingDamageModifier(1),
        ], [
            new SubstractingDamageModifier(3),
        ]);
    }
}