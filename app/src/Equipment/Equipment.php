<?php
declare(strict_types=1);

namespace Tournament\Equipment;


use Tournament\DamageModifier;

interface Equipment
{
    public function getOwnDamageModifier(): DamageModifier;
}