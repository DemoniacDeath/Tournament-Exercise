<?php
declare(strict_types=1);

namespace Tournament\DamageModifier;

use Doctrine\Common\Collections\ArrayCollection;

class DummyDamageModifier extends CollectionDamageModifier
{
    public function __construct()
    {
        parent::__construct(new ArrayCollection());
    }
}