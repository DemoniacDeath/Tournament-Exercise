<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Damage;
use Tournament\Equipment\Defense\Defence;
use Tournament\Equipment\Equipment;

interface Fighter
{
    public function equip(Equipment $equipment): self;

    public function engage(Fighter $fighter): void;

    public function hitPoints(): int;

    public function initialHitPoints(): int;

    public function takeDamage(Damage $damage): void;

    public function modifyDamage(Damage $damage): Damage;

    /**
     * @return iterable|Defence[]
     */
    public function defences(): iterable;
}