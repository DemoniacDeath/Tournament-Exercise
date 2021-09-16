<?php
declare(strict_types=1);

namespace Tournament\Fighter\Strategy\Equipment;


use Tournament\Equipment\Weapon\Weapon;

interface WeaponEquippingStrategy
{
    public function equippingWeapon(Weapon $weapon): Weapon;
}