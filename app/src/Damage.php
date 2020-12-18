<?php
declare(strict_types=1);

namespace Tournament;


class Damage
{
    private int $amount;
    private DamageType $type;

    public function __construct(int $amount, DamageType $type)
    {
        if ($amount < 0) {
            $amount = 0;
        }
        $this->amount = $amount;
        $this->type = $type;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getType(): DamageType
    {
        return $this->type;
    }

    public function mul(int $amount): self
    {
        return new self($this->amount * $amount, $this->type);
    }

    public function zero(): self
    {
        return $this->mul(0);
    }

    public function add(int $amount): self
    {
        return new self($this->amount + $amount, $this->type);
    }

    public function sub(int $amount): self
    {
        return $this->add(-$amount);
    }
}