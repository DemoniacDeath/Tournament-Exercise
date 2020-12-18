<?php
declare(strict_types=1);

namespace Tournament\Equipment\Defense;


class Buckler extends Defence
{
    public function __construct()
    {
        parent::__construct([], [new BucklerDamageModifier()]);
    }
}