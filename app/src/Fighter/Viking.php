<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Equipment\Weapon\Axe;

class Viking extends AbstractFighter
{
    public function __construct()
    {
        $this->equip(new Axe());
        parent::__construct();
    }

    public function initialHitPoints(): int
    {
        return 120;
    }
}