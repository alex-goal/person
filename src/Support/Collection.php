<?php

namespace AlexGoal\Person\Support;

use InvalidArgumentException;

class Collection
{
    /** @var array */
    private $types;

    /** @var array */
    protected $data = [];

    /**
     * @param array $types
     */
    public function __construct(array $types)
    {
        $this->types = $types;
    }

    /**
     * @param array $types
     * @return Collection
     */
    public static function create(array $types): Collection
    {
        return new self($types);
    }

    /**
     * @param string|null $type
     * @return array
     */
    public function get(string $type = null): array
    {
        return empty($type)
            ? $this->data
            : $this->filter(function ($element) use ($type) {
                return get_class($element) == $type;
            });
    }

    /**
     * @param string|null $type
     * @return mixed|null
     */
    public function getFirst(string $type = null)
    {
        return $this->has($type)
            ? array_values($this->get($type))[0]
            : null;
    }

    /**
     * @param callable $callback
     * @param string|null $type
     * @return array
     */
    public function map(string $type, callable $callback): array
    {
        return array_map($callback, $this->get($type));
    }

    /**
     * @param callable $callback
     * @return array
     */
    public function filter(callable $callback): array
    {
        return array_filter($this->data, $callback);
    }

    /**
     * @param mixed $element
     * @return self
     * @throws InvalidArgumentException
     */
    public function add($element): self
    {
        if (! in_array(get_class($element), $this->types)) {
            throw new InvalidArgumentException(
                'Value must be one of the types ' . implode(', ', $this->types)
                . '; value is ' . get_class($element)
            );
        }

        $this->data[] = $element;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->data);
    }

    /**
     * @param string|null $type
     * @return int
     */
    public function count(string $type = null): int
    {
        return count($this->get($type));
    }

    /**
     * @param string|null $type
     * @return bool
     */
    public function has(string $type = null): bool
    {
        return $this->count($type) > 0;
    }
}