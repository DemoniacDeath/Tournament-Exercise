<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Doctrine\Common\Collections\ArrayCollection;
use Tournament\AbstractDamageModifier;
use Tournament\Damage;
use Tournament\DamageType;

class Buckler extends Defence
{
    public function __construct()
    {
        parent::__construct(
            new ArrayCollection([
                new class extends AbstractDamageModifier {
                    private bool $isDestroyed = false;
                    private int $hitsReceived = 0;
                    private int $hitsBlockedByAxe = 0;

                    public function modifyDamage(Damage $damage): Damage
                    {
                        $this->hitsReceived++;
                        if ($this->shouldBlock()) {
                            $damage = $damage->zero();
                            $this->blocked($damage->getType());
                        }
                        return $damage;
                    }

                    private function shouldBlock(): bool
                    {
                        if ($this->isDestroyed) {
                            return false;
                        }
                        return $this->hitsReceived % 2 !== 0;
                    }

                    private function blocked(DamageType $damageType): void
                    {
                        if ($damageType->equals(DamageType::AXE())) {
                            $this->hitsBlockedByAxe++;
                            if ($this->hitsBlockedByAxe >= 3) {
                                $this->isDestroyed = true;
                            }
                        }
                    }
                }
            ]),
            new ArrayCollection()
        );
    }
}