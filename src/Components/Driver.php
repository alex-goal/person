<?php

namespace AlexGoal\Person\Components;

use AlexGoal\Person\Traits\HasDocType;
use AlexGoal\Person\Traits\HasFullNumber;
use AlexGoal\Person\Traits\HasPeriod;

class Driver
{
    use HasDocType,
        HasFullNumber,
        HasPeriod {
            HasFullNumber::getFullNumberByFormat as getFullNumberByFormatTrait;
        }

    /**
     * Driver Constructor.
     *
     * @param string|null $fullNumber
     */
    public function __construct(?string $fullNumber = null)
    {
        if (! empty($fullNumber)) {
            $this->setFullNumber($fullNumber);
        }
    }

    /**
     * Create Driver.
     *
     * @param string|null $fullNumber
     * @return Driver
     */
    public static function create(?string $fullNumber = null): Driver
    {
        return new self($fullNumber);
    }

    /**
     * @param string $format
     * @return string
     */
    public function getFullNumberByFormat(string $format = 'XXXX XXXXXX'): ?string
    {
        return $this->getFullNumberByFormatTrait($format);
    }
}