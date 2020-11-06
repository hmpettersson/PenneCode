<?php

namespace App\Entities;

use JsonSerializable;

class Address implements JsonSerializable
{
    private string $streetAddress;
    private string $city;
    private string $state;
    private string $postalCode;

    public function __construct(string $streetAddress, string $city, string $state, string $postalCode)
    {
        $this->streetAddress = $streetAddress;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
    }

    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(string $streetAddress): void
    {
        $this->streetAddress = $streetAddress;
    }

    public function getCity(): string
    {
        return $this-> city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getState(): string
    {
        return $this-> state;
    }
    
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getPostalCode(): string
    {
        return $this-> postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function jsonSerialize()
    {
        return [
            'streetAddress' => $this->streetAddress,
            'city' => $this->city,
            'state' => $this->state,
            'postalCode' => $this->postalCode
        ];
    }
}
