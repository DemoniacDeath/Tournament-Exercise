<?php
declare(strict_types=1);

namespace Tournament;


interface DamageModifier
{
    public function modifyDamage(Damage $damage): Damage;
}