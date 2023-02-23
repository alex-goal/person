<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Components\Phone;
use AlexGoal\Person\Support\Collection;
use Exception;

trait HasPhones
{
    /** @var Collection */
    protected $phones;

    /**
     * @return Collection
     */
    public function getPhones(): Collection
    {
        if (empty($this->phones)) {
            $this->phones = new Collection([Phone::class]);
        }

        return $this->phones;
    }

    /**
     * @param string $type
     * @return array
     */
    public function getPhonesByType(string $type): array
    {
        return $this->getPhones()
            ->filter(function (Phone $phone) use ($type) {
                return $phone->getType() == $type;
            });
    }

    /**
     * @param Phone $phone
     * @return HasPhones
     */
    public function addPhone(Phone $phone): self
    {
        $this->getPhones()->add($phone);

        return $this;
    }

    /**
     * @param array $phones
     * @return self
     * @throws Exception
     */
    public function addPhones(array $phones): self
    {
        foreach ($phones as $phone) {
            $this->addPhone($phone);
        }

        return $this;
    }

    /**
     * @param string|null $type
     * @return Phone|null
     */
    public function getFirstPhone(string $type = null): ?Phone
    {
        return $this->getPhones()->getFirst($type);
    }

    /**
     * @param string|null $type
     * @return int
     */
    public function getCountPhones(string $type = null): int
    {
        return empty($type)
            ? $this->getPhones()->count()
            : count($this->getPhonesByType($type));
    }

    /**
     * @param string|null $type
     * @return bool
     */
    public function hasPhones(string $type = null): bool
    {
        return $this->getCountPhones($type) > 0;
    }
}