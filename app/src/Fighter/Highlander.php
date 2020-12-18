<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Equipment\Weapon\GreatSword;

class Highlander extends AbstractFighter
{
    public function __construct()
    {
        parent::__construct();
        $this->equip(new GreatSword());
    }

    public function initialHitPoints(): int
    {
        return 150;
    }
}