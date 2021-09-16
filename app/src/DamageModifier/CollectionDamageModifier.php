<?php
declare(strict_types=1);

namespace Tournament\DamageModifier;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tournament\AbstractDamageModifier;
use Tournament\Damage;
use Tournament\DamageModifier;

class CollectionDamageModifier extends AbstractDamageModifier
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

    public static function combine(DamageModifier $firstDamageModifier, DamageModifier $secondDamageModifier): DamageModifier
    {
        $newCollection = $firstDamageModifier instanceof self
            ? new ArrayCollection($firstDamageModifier->collection->toArray())
            : new ArrayCollection([$firstDamageModifier]);
        if ($secondDamageModifier instanceof self) {
            foreach ($secondDamageModifier->collection as $damageModifier) {
                $newCollection->add($damageModifier);
            }
        } else {
            $newCollection->add($secondDamageModifier);
        }
        return new CollectionDamageModifier($newCollection);
    }

    public function modifyDamage(Damage $damage): Damage
    {
        foreach ($this->collection as $damageModifier) {
            $damage = $damageModifier->modifyDamage($damage);
        }
        return $damage;
    }
}