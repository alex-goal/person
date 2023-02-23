<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Components\Inn;
use AlexGoal\Person\Components\Passport;
use AlexGoal\Person\Support\Collection;
use Exception;

trait HasDocs
{
    /** @var Collection */
    protected $docs;

    /**
     * @return Collection
     */
    public function getDocs(): Collection
    {
        if (empty($this->docs)) {
            $this->docs = new Collection([
                Passport::class,
                Inn::class,
            ]);
        }

        return $this->docs;
    }

    /**
     * @param string $type
     * @return array
     */
    public function getDocsByType(string $type): array
    {
        return $this->getDocs()->get($type);
    }

    /**
     * @return array
     */
    public function getPassports(): array
    {
        return $this->getDocs()->get(Passport::class);
    }

    /**
     * @return array
     */
    public function getPassport(): array
    {
        return $this->getDocs()->getFirst(Passport::class);
    }

    /**
     * @return Inn|null
     */
    public function getInn(): ?Inn
    {
        return $this->getDocs()->getFirst(Inn::class);
    }

    /**
     * @param mixed $doc
     * @return self
     * @throws Exception
     */
    public function addDoc($doc): self
    {
        $this->getDocs()->add($doc);

        return $this;
    }

    /**
     * @param array $docs
     * @return self
     * @throws Exception
     */
    public function addDocs(array $docs): self
    {
        foreach ($docs as $doc) {
            $this->addDoc($doc);
        }

        return $this;
    }

    /**
     * @param string|null $type
     * @return int
     */
    public function getCountDocs(string $type = null): int
    {
        return empty($type)
            ? $this->getDocs()->count()
            : count($this->getDocsByType($type));
    }

    /**
     * @param string|null $type
     * @return bool
     */
    public function hasDocs(string $type = null): bool
    {
        return $this->getDocs()->has($type);
    }

    /**
     * @return mixed|null
     */
    public function getRandDoc()
    {
        return $this->getDocs()->getRand();
    }
}