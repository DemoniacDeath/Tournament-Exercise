<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


use Doctrine\Common\Collections\ArrayCollection;

class Buckler extends Defence
{
    public function __construct()
    {
        parent::__construct(new ArrayCollection(), new ArrayCollection([new BucklerDamageModifier()]));
    }
}