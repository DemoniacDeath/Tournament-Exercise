<?php
declare(strict_types=1);

namespace Tournament\Fighter\Strategy\DamageTaking;


use Tournament\Damage;
use Tournament\Fighter\Fighter;
use Tournament\Fighter\Strategy;

interface DamageTakingStrategy extends Strategy
{
    public function damageTaken(Damage $damage, Fighter $fighter): void;
}