<?php

namespace AlexGoal\Person\Components;

use Carbon\Carbon;
use DateTimeInterface;

class Period
{
    /** @var Carbon */
    protected $start;

    /** @var Carbon */
    protected $finish;

    /**
     * Period Constructor.
     *
     * @param DateTimeInterface|string|null $start
     * @param DateTimeInterface|string|null $finish
     */
    public function __construct($start = null, $finish = null)
    {
        if (! empty($start)) {
            $this->setStart($start);
        }

        if (! empty($finish)) {
            $this->setFinish($finish);
        }
    }

    /**
     * Create Period.
     *
     * @param DateTimeInterface|string|null $start
     * @param DateTimeInterface|string|null $finish
     * @return Period
     */
    public static function create($start = null, $finish = null): Period
    {
        return new self($start, $finish);
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
        $this->start = $format
            ? Carbon::createFromFormat($format, $start)
            : Carbon::parse($start);

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
    public function getFinish(): ?Carbon
    {
        return $this->finish;
    }

    /**
     * Установить конец периода.
     *
     * @param DateTimeInterface|string $finish
     * @param string|null $format
     * @return Period
     */
    public function setFinish($finish, string $format = null): self
    {
        $this->start = $format
            ? Carbon::createFromFormat($format, $finish)
            : Carbon::parse($finish);

        return $this;
    }

    /**
     * Конец периода установлен?
     *
     * @return bool
     */
    public function hasFinish(): bool
    {
        return ! empty($this->start);
    }

}