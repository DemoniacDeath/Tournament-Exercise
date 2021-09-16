<?php
declare(strict_types=1);

namespace Tournament\Fighter\Strategy\Equipment;


use Tournament\DamageModifier\PoisonDamageModifier;
use Tournament\Equipment\Weapon\Weapon;

class Vicious implements WeaponEquippingStrategy
{
    public function equippingWeapon(Weapon $weapon): Weapon
    {
        return $weapon->addDamageModifier(new PoisonDamageModifier());
    }
}