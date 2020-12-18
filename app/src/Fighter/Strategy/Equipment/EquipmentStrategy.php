<?php
declare(strict_types=1);

namespace Tournament\Fighter\Strategy\Equipment;


use Tournament\Equipment\Defense\Defence;
use Tournament\Equipment\Weapon\Weapon;
use Tournament\Fighter\Strategy;

interface EquipmentStrategy extends Strategy
{
    public function equippingWeapon(Weapon $weapon);

    public function equippingDefence(Defence $defence);
}