<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Components\Driver;
use AlexGoal\Person\Helpers\Date;
use Carbon\Carbon;
use DateTimeInterface;

trait HasPeriod
{
    /** @var Carbon */
    protected $startDate;

    /** @var Carbon */
    protected $endDate;

    /**
     * @param DateTimeInterface|string $start
     * @param DateTimeInterface|string $end
     * @return HasPeriod|Driver
     */
    public function setPeriod($start, $end): self
    {
        return $this
            ->setStartDate($start)
            ->setEndDate($end);
    }

    /**
     * Получить начало периода.
     *
     * @return Carbon
     */
    public function getStartDate(): ?Carbon
    {
        return $this->startDate;
    }

    /**
     * @param string $format
     * @return string|null
     */
    public function getStartDateByFormat(string $format = 'Y-m-d'): ?string
    {
        return $this->hasStartDate()
            ? $this->getStartDate()->format($format)
            : null;
    }

    /**
     * Установить начало периода.
     *
     * @param DateTimeInterface|string $start
     * @param string|null $format
     * @return self
     */
    public function setStartDate($start, string $format = null): self
    {
        $this->startDate = Date::createCarbon($start, $format);

        return $this;
    }

    /**
     * Начало периода установлено?
     *
     * @return bool
     */
    public function hasStartDate(): bool
    {
        return ! empty($this->startDate);
    }

    /**
     * Получить конец периода.
     *
     * @return Carbon
     */
    public function getEndDate(): ?Carbon
    {
        return $this->endDate;
    }

    /**
     * @param string $format
     * @return string|null
     */
    public function getEndDateByFormat(string $format = 'Y-m-d'): ?string
    {
        return $this->hasEndDate()
            ? $this->getEndDate()->format($format)
            : null;
    }

    /**
     * Установить конец периода.
     *
     * @param DateTimeInterface|string $end
     * @param string|null $format
     * @return self
     */
    public function setEndDate($end, string $format = null): self
    {
        $this->endDate = Date::createCarbon($end, $format);

        return $this;
    }

    /**
     * Конец периода установлен?
     *
     * @return bool
     */
    public function hasEndDate(): bool
    {
        return ! empty($this->endDate);
    }

    /**
     * Входит ли текущая дата или указанная в период?
     *
     * @param null $date
     * @param string|null $format
     * @return bool
     */
    public function isValidPeriod($date = null, string $format = null): bool
    {
        $date = Date::createCarbonOrNow($date, $format);

        if ($this->hasStartDate() && $this->hasEndDate()) {
            return $this->startDate <= $date && $this->endDate >= $date;
        }

        if ($this->hasStartDate()) {
            return $this->startDate <= $date;
        }

        if ($this->hasEndDate()) {

            return $this->endDate >= $date;
        }

        return true;
    }
}