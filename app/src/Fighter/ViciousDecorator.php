<?php
declare(strict_types=1);

namespace Tournament\Fighter;


use Tournament\Damage;
use Tournament\Equipment\Equipment;
use Tournament\Equipment\Weapon\PoisonedDecorator;
use Tournament\Equipment\Weapon\AbstractWeapon;

class ViciousDecorator implements Fighter
{
    /**
     * @var Fighter
     */
    private Fighter $decorated;

    public function __construct(Fighter $decorated)
    {
        $this->decorated = $decorated;
    }

    public function equip(Equipment $equipment): Fighter
    {
        if ($equipment instanceof AbstractWeapon) {
            $equipment = new PoisonedDecorator($equipment);
        }
        $this->decorated->equip($equipment);
        return $this;
    }

    public function engage(Fighter $fighter): void
    {
        $this->decorated->engage($fighter);
    }

    public function hitPoints(): int
    {
        return $this->decorated->hitPoints();
    }

    public function takeDamage(Damage $damage): void
    {
        $this->decorated->takeDamage($damage);
    }

    public function initialHitPoints(): int
    {
        return $this->decorated->initialHitPoints();
    }
}