<?php

namespace App\Entities;

use JsonSerializable;

class PhoneNumber implements JsonSerializable
{
    private string $type;
    private string $number;
    private string $personId;

    public function __construct(string $type, string $number, string $personId)
    {
        $this->type = $type;
        $this->number = $number;
        $this->personId = $personId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getPersonId(): string
    {
        return $this->personId;
    }

    public function setPersonId(string $personId): void
    {
        $this->personId = $personId;
    }

    public function isObject(object $object): bool
    {
        if (is_string($object->type) && is_string($object->number)) {
            return true;
        }
        
        return false;
    }

    public function jsonSerialize()
    {
        return $this->number;
    }
}
