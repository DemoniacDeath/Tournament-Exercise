<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Doctrine\Common\Collections\ArrayCollection;
use Tournament\Damage;
use Tournament\DamageModifier\ClosureDamageModifier;

class Armor extends Defence
{
    public function __construct()
    {
        parent::__construct(
            new ArrayCollection([
                new ClosureDamageModifier(fn(Damage $damage) => $damage->sub(3)),
            ]),
            new ArrayCollection([
                new ClosureDamageModifier(fn(Damage $damage) => $damage->sub(1)),
            ])
        );
    }
}