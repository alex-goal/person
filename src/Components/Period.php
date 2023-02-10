<?php

namespace AlexGoal\Person\Components;

use AlexGoal\Person\Helpers\Date;
use Carbon\Carbon;
use DateTimeInterface;

class Period
{
    /** @var Carbon */
    protected $start;

    /** @var Carbon */
    protected $end;

    /**
     * Period Constructor.
     *
     * @param DateTimeInterface|string|null $start
     * @param DateTimeInterface|string|null $end
     */
    public function __construct($start = null, $end = null)
    {
        if (! empty($start)) {
            $this->setStart($start);
        }

        if (! empty($end)) {
            $this->setEnd($end);
        }
    }

    /**
     * Create Period.
     *
     * @param DateTimeInterface|string|null $start
     * @param DateTimeInterface|string|null $end
     * @return Period
     */
    public static function create($start = null, $end = null): Period
    {
        return new self($start, $end);
    }

    /**
     * Получить начало периода.
     *
     * @return Carbon
     */
    public function getStart(): ?Carbon
    {
        return $this->start;
    }

    /**
     * Установить начало периода.
     *
     * @param DateTimeInterface|string $start
     * @param string|null $format
     * @return Period
     */
    public function setStart($start, string $format = null): self
    {
        $this->start = Date::createCarbon($start, $format);

        return $this;
    }

    /**
     * Начало периода установлено?
     *
     * @return bool
     */
    public function hasStart(): bool
    {
        return ! empty($this->start);
    }

    /**
     * Получить конец периода.
     *
     * @return Carbon
     */
    public function getEnd(): ?Carbon
    {
        return $this->end;
    }

    /**
     * Установить конец периода.
     *
     * @param DateTimeInterface|string $end
     * @param string|null $format
     * @return Period
     */
    public function setEnd($end, string $format = null): self
    {
        $this->end = Date::createCarbon($end, $format);

        return $this;
    }

    /**
     * Конец периода установлен?
     *
     * @return bool
     */
    public function hasEnd(): bool
    {
        return ! empty($this->end);
    }

    /**
     * Входит ли текущая дата или указанная в период?
     *
     * @param null $date
     * @param string|null $format
     * @return bool
     */
    public function isValid($date = null, string $format = null): bool
    {
        $date = Date::createCarbonOrNow($date, $format);

        if ($this->hasStart() && $this->hasEnd()) {
            return $this->start <= $date && $this->end >= $date;
        }

        if ($this->hasStart()) {
            return $this->start <= $date;
        }

        if ($this->hasEnd()) {

            return $this->end >= $date;
        }

        return true;
    }
}