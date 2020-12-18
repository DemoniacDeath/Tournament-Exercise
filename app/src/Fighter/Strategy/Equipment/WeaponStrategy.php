<?php
declare(strict_types=1);

namespace Tournament\Fighter\Strategy\Equipment;


use Tournament\Equipment\Weapon\Weapon;
use Tournament\Fighter\Strategy;

interface WeaponStrategy extends Strategy
{
    public function equippingWeapon(Weapon $weapon): Weapon;
}