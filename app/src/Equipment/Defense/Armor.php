<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Doctrine\Common\Collections\ArrayCollection;
use Tournament\DamageModifier\SubstractingDamageModifier;

class Armor extends Defence
{
    public function __construct()
    {
        parent::__construct(new ArrayCollection([
            new SubstractingDamageModifier(1),
        ]), new ArrayCollection([
            new SubstractingDamageModifier(3),
        ]));
    }
}