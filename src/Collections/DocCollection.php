<?php

namespace AlexGoal\Person\Collections;

use AlexGoal\Person\Components\Passport;
use Exception;

class DocCollection
{
    const DOCUMENT_TYPES = [
        Passport::class,
    ];

    /** @var array */
    protected $docs = [];

    /**
     * Create DocCollection
     *
     * @return static
     */
    public static function create(): self
    {
        return new self;
    }

    /**
     * @param string|null $type
     * @return array
     */
    public function get(string $type = null): array
    {
        if (empty($type)) {
            return $this->docs;
        }

        if (! $this->canPush($type)) {
            return [];
        }

        return array_filter($this->docs, function ($doc) use ($type) {
            return get_class($doc) == $type;
        });
    }

    /**
     * @param mixed $doc
     * @return DocCollection
     * @throws Exception
     */
    public function push($doc): self
    {
        if (! $this->canPush($doc)) {
            throw new Exception(
                'Invalid type of document. Available: ' .
                implode(', ', self::DOCUMENT_TYPES)
            );
        }

        $this->docs[] = $doc;

        return $this;
    }

    /**
     * @return array
     */
    public function getPassports(): array
    {
        return $this->get(Passport::class);
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
     * @param string $type
     * @return bool
     */
    public function has(string $type): bool
    {
        return ! empty($this->get($type));
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->docs);
    }

    /**
     * @param mixed $doc
     * @return bool
     */
    public function canPush($doc): bool
    {
        if (is_object($doc)) {
            $doc = get_class($doc);
        } elseif (! is_string($doc)) {
            return false;
        }

        return in_array($doc, self::DOCUMENT_TYPES);
    }
}