<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Equipment\Weapon\GreatSword;

class Highlander extends AbstractFighter
{
    public function __construct()
    {
        $this->equip(new GreatSword());
        parent::__construct();
    }

    public function initialHitPoints(): int
    {
        return 150;
    }
}