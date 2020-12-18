<?php
declare(strict_types=1);

namespace Tournament\DamageModifier;


use Doctrine\Common\Collections\Collection;
use Tournament\Damage;
use Tournament\DamageModifier;

class CollectionDamageModifier implements DamageModifier
{
    /**
     * @var Collection|DamageModifier[]
     */
    private Collection $collection;

    /**
     * CollectionDamageModifier constructor.
     * @param Collection|DamageModifier[] $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function modifyDamage(Damage $damage): Damage
    {
        return array_reduce(
            $this->collection->toArray(),
            fn(Damage $damage, DamageModifier $damageModifier) => $damageModifier->modifyDamage($damage),
            $damage
        );
    }
}