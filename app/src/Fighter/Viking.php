<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Equipment\Weapon\Axe;

class Viking extends AbstractFighter
{
    public function __construct()
    {
        parent::__construct();
        $this->equip(new Axe());
    }

    public function initialHitPoints(): int
    {
        return 120;
    }
}