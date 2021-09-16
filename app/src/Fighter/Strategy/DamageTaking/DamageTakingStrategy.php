<?php
declare(strict_types=1);

namespace Tournament\Fighter\Strategy\DamageTaking;


use Tournament\Damage;
use Tournament\Fighter\Fighter;

interface DamageTakingStrategy
{
    public function damageTaken(Damage $damage, Fighter $fighter): void;
}