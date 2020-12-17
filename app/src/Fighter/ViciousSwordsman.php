<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Equipment\Equipment;
use Tournament\Equipment\Weapon\AbstractWeapon;
use Tournament\Equipment\Weapon\Poisoned;

class ViciousSwordsman extends Swordsman
{
    public function equip(Equipment $equipment): self
    {
        if ($equipment instanceof AbstractWeapon) {
            $equipment = new Poisoned($equipment);
        }
        parent::equip($equipment);
        return $this;
    }
}