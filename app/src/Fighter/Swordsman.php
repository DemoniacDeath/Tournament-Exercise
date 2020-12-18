<?php
declare(strict_types=1);

namespace Tournament\Fighter;

use Tournament\Equipment\Weapon\Sword;

class Swordsman extends AbstractFighter
{
    public function __construct()
    {
        parent::__construct();
        $this->equip(new Sword());
    }

    public function initialHitPoints(): int
    {
        return 100;
    }
}
