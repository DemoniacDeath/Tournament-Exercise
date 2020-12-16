<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;
use Tournament\Equipment\Equipment;

interface Weapon extends Equipment
{
    public function getDamage(): Damage;

    public function canAttack(): bool;

    public function beforeAttack(): void;
}