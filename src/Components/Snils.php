<?php

namespace AlexGoal\Person\Components;

use AlexGoal\Person\Helpers\Format;
use AlexGoal\Person\Helpers\Str;
use AlexGoal\Person\Traits\HasDocType;

class Snils
{
    use HasDocType;

    protected $number;

    /**
     * Snils Constructor.
     *
     * @param string|null $number
     */
    public function __construct(?string $number = null)
    {
        if (! empty($number)) {
            $this->setNumber($number);
        }
    }

    /**
     * Create Snils.
     *
     * @param string|null $number
     * @return Snils
     */
    public static function create(?string $number = null): Snils
    {
        return new self($number);
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @return string|null
     */
    public function getNumberFormat(): ?string
    {
        return $this->number
            ? Format::get($this->number, 'XXX-XXX-XXX XX')
            : null;
    }

    /**
     * @param mixed $number
     * @return self
     */
    public function setNumber(string $number): self
    {
        $this->number = Str::onlyNumeric($number, 11);

        return $this;
    }

    /**
     * @return bool
     */
    public function hasNumber(): bool
    {
        return ! empty($this->number);
    }
}