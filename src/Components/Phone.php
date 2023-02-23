<?php

namespace AlexGoal\Person\Components;

use \AlexGoal\Person\Helpers\Phone as PhoneHelper;

class Phone
{
    /** @var string */
    protected $number;

    /** @var string */
    protected $type;

    /**
     * Phone Constructor.
     *
     * @param string|null $number
     * @param string|null $format
     */
    public function __construct(?string $number = null, ?string $format = null)
    {
        if (! empty($number)) {
            $this->setNumber($number, $format);
        }
    }

    /**
     * Create Phone.
     *
     * @param string|null $number
     * @param string|null $format
     * @return Phone
     */
    public static function create(?string $number = null, ?string $format = null): Phone
    {
        return new self($number, $format);
    }

    /**
     * @return string
     */
    public function getNumber(string $format = null): ?string
    {
        return $format
            ? (PhoneHelper::transform($this->number, $format) ?? $this->number)
            : $this->number;
    }

    /**
     * @param string $number
     * @param string|null $format
     * @return self
     */
    public function setNumber(string $number, ?string $format = null): self
    {
        $this->number = $format
            ? PhoneHelper::transform($number, $format)
            : $number;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

}