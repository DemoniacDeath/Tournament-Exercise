<?php
declare(strict_types=1);

namespace Tournament\Fighter\Strategy\Equipment;


use Tournament\DamageModifier\PoisonDamageModifier;
use Tournament\Equipment\Defense\Defence;
use Tournament\Equipment\Weapon\Weapon;

class Vicious implements WeaponStrategy
{
    public function equippingWeapon(Weapon $weapon): Weapon
    {
        return $weapon->addDamageModifier(new PoisonDamageModifier());
    }
}