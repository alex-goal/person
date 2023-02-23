<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Helpers\Format;
use AlexGoal\Person\Helpers\Str;

trait HasFullNumber
{
    /** @var string */
    protected $series;

    /** @var string */
    protected $number;

    /**
     * @return string|null
     */
    public function getFullNumber(): ?string
    {
        return $this->hasFullNumber()
            ? $this->series . $this->number
            : null;
    }

    /**
     * @param string $format
     * @return string
     */
    public function getFullNumberByFormat(string $format = 'XX XX XXXXXX'): ?string
    {
        return $this->hasFullNumber()
            ? Format::get($this->getFullNumber(), $format)
            : null;
    }

    /**
     * @param string $fullNumber
     * @return self
     */
    public function setFullNumber(string $fullNumber): self
    {
        $fullNumber = Str::onlyNumeric($fullNumber, 10);

        if (mb_strlen($fullNumber) == 10) {
            $this->series = mb_substr($fullNumber, 0, 4);
            $this->number = mb_substr($fullNumber, 4, 6);
        }

        return $this;
    }

    /**
     * @return void
     */
    protected function updateFullNumber(): void
    {
        if ($this->hasSeries() && $this->hasNumber()) {
            $this->setFullNumber($this->series . $this->number);
        }
    }

    /**
     * @return bool
     */
    public function hasFullNumber(): bool
    {
        return ! empty($this->series)
            && ! empty($this->number);
    }

    /**
     * @return bool
     */
    public function isValidFullNumber(): bool
    {
        return $this->hasFullNumber()
            && mb_strlen($this->getFullNumber()) == 10;
    }

    /**
     * @return string
     */
    public function getSeries(): string
    {
        return $this->series;
    }

    /**
     * @param string $series
     * @return self
     */
    public function setSeries(string $series): self
    {
        $this->series = Str::onlyNumeric($series, 4);

        $this->updateFullNumber();

        return $this;
    }

    /**
     * @return bool
     */
    public function hasSeries(): bool
    {
        return ! empty($this->series);
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return self
     */
    public function setNumber(string $number): self
    {
        $this->number = Str::onlyNumeric($number, 6);

        $this->updateFullNumber();

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