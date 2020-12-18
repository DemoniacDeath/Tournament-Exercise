<?php
declare(strict_types=1);

namespace Tournament\Fighter\Strategy\Equipment;


use Tournament\Equipment\Defense\Defence;
use Tournament\Equipment\Weapon\PoisonDamageModifier;
use Tournament\Equipment\Weapon\Weapon;

class ViciousEquipmentStrategy implements EquipmentStrategy
{
    public function equippingWeapon(Weapon $weapon)
    {
        $weapon->addDamageModifier(new PoisonDamageModifier());
        return $weapon;
    }

    public function equippingDefence(Defence $defence)
    {
        return $defence;
    }

}