<?php

namespace App\Entities;

use App\Entities\PhoneNumber;

class NumbersCollection
{
    private array $numbers = [];

    public function getNumbers(): array
    {
        return $this->numbers;
    }
    
    public function addPhoneNumber(PhoneNumber $phoneNumber): void
    {
        //array_push($this->numbers, $phoneNumber);
        $this->numbers[] = $phoneNumber;
    }

    public function deleteNumber(PhoneNumber $phoneNumber): void
    {
        $index = array_search($phoneNumber->getNumber(), $this->numbers);
        if ($index != null) {
            unset($this->numbers[$index]);
        }
    }
}
