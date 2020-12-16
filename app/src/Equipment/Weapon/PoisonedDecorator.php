<?php
declare(strict_types=1);

namespace Tournament\Equipment\Weapon;


use Tournament\Damage;

class PoisonedDecorator implements Weapon
{
    private Weapon $decorated;
    private int $attackCounter = 0;

    /**
     * PoisonedDecorator constructor.
     * @param Weapon $decorated
     */
    public function __construct(Weapon $decorated)
    {
        $this->decorated = $decorated;
    }

    public function getDamage(): Damage
    {
        if ($this->attackCounter <= 2) {
            return $this->decorated->getDamage()->add(20);
        }
        return $this->decorated->getDamage();
    }

    public function canAttack(): bool
    {
        return $this->decorated->canAttack();
    }

    public function beforeAttack(): void
    {
        $this->attackCounter++;
        $this->decorated->beforeAttack();
    }
}