<?php
declare(strict_types=1);

namespace Tournament;


class Damage
{
    private int $amount;
    private DamageType $type;

    /**
     * Damage constructor.
     * @param int $amount
     * @param DamageType $type
     */
    public function __construct(int $amount, DamageType $type)
    {
        if ($amount < 0) {
            $amount = 0;
        }
        $this->amount = $amount;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return DamageType
     */
    public function getType(): DamageType
    {
        return $this->type;
    }

    public function zero(): self
    {
        return new self(0, $this->type);
    }

    public function mul(int $amount): self
    {
        return new self($this->amount * $amount, $this->type);
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