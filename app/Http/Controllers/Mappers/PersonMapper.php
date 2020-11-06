<?php

namespace App\Http\Controllers\Mappers;

use App\Http\Controllers\Controller;
use App\Models\Person as PersonModel;
use App\Models\PhoneNumber as PhoneNoModel;
use App\Entities\Person;
use App\Entities\Address;
use App\Entities\NumbersCollection;
use App\Entities\PhoneNumber;

class PersonMapper extends Controller
{
    public function addPerson(Person $newPerson): void
    {
        $person = new PersonModel();
        $person->first_name = $newPerson->getFirstName();
        $person->last_name = $newPerson->getLastName();
        $person->gender = $newPerson->getGender();
        $person->age = $newPerson->getAge();
        $person->street_address = $newPerson->getAddress()->getStreetAddress();
        $person->city = $newPerson->getAddress()->getCity();
        $person->state = $newPerson->getAddress()->getState();
        $person->postal_code = $newPerson->getAddress()->getPostalCode();
        $person->save();
        $personId = $person->id;


        $phoneNoArray = $newPerson->getPhoneNumbers()->getNumbers();
        foreach ($phoneNoArray as $aNumber) {
            $num = new PhoneNoModel();
            $num->type =$aNumber->getType();
            $num->number = $aNumber->getNumber();
            $num->person_id = $personId;
            $num->save();
        }
    }

    public function findAllPersons(): array
    {
        $personArray = PersonModel::all();
        $numbersArray = PhoneNoModel::all();

        $resultArray = [];

        foreach ($personArray as $eachPerson) {
            $noCollection = new NumbersCollection();
                
            foreach ($numbersArray as $theNumber) {
                $phoneNo = new PhoneNumber($theNumber->type, $theNumber->number, $theNumber->person_id);
                if ($theNumber->person_id === $eachPerson->id) {
                    $noCollection->addPhoneNumber($phoneNo);
                }
            }
            $address = new Address(
                $eachPerson->street_address,
                $eachPerson->city,
                $eachPerson->state,
                $eachPerson->postal_code
            );
            $person = new Person(
                $eachPerson->first_name,
                $eachPerson->last_name,
                $eachPerson->gender,
                $eachPerson->age,
                $address,
                $noCollection
            );
            $person->setId($eachPerson->id);
            array_push($resultArray, $person);
        }
        return $resultArray;
    }
    public function getPersonById(int $id): Person
    {
        $personInfoDB = PersonModel::where('id', $id)->first();
        if (!isset($personInfoDB)) {
            echo 'The person requested does not exist in the database. Check person id.';
            exit;
        }
        $numbersArray = $personInfoDB->phoneNumbers()->get();

        $noCollection = new NumbersCollection();
                
        foreach ($numbersArray as $theNumber) {
            $phoneNo = new PhoneNumber($theNumber->type, $theNumber->number, $theNumber->person_id);
            $noCollection->addPhoneNumber($phoneNo);
        }

        $address = new Address(
            $personInfoDB->street_address,
            $personInfoDB->city,
            $personInfoDB->state,
            $personInfoDB->postal_code
        );
        $person = new Person(
            $personInfoDB->first_name,
            $personInfoDB->last_name,
            $personInfoDB->gender,
            $personInfoDB->age,
            $address,
            $noCollection
        );
        $person->setId($personInfoDB->id);
        return $person;
    }
    public function updatePersons(array $infoToUpdateArray, int $id): void
    {
        $fetchedPersonModel = PersonModel::where('id', $id)->firstOrFail();

        if (isset($infoToUpdateArray['firstName'])) {
            $fetchedPersonModel->first_name = $infoToUpdateArray['firstName'];
        }
        if (isset($infoToUpdateArray['lastName'])) {
            $fetchedPersonModel->last_name = $infoToUpdateArray['lastName'];
        }
        if (isset($infoToUpdateArray['gender'])) {
            $fetchedPersonModel->gender = $infoToUpdateArray['gender'];
        }
        if (isset($infoToUpdateArray['age'])) {
            $fetchedPersonModel->age = $infoToUpdateArray['age'];
        }
        if (isset($infoToUpdateArray['address']['streetAddress'])) {
            $fetchedPersonModel->street_address = $infoToUpdateArray['address']['streetAddress'];
        }
        if (isset($infoToUpdateArray['address']['city'])) {
            $fetchedPersonModel->city = $infoToUpdateArray['address']['city'];
        }
        if (isset($infoToUpdateArray['address']['state'])) {
            $fetchedPersonModel->state = $infoToUpdateArray['address']['state'];
        }
        if (isset($infoToUpdateArray['address']['postalCode'])) {
            $fetchedPersonModel->postal_code = $infoToUpdateArray['address']['postalCode'];
        }
        if (isset($infoToUpdateArray['phoneNumbers'])) {
            $allNewNumbersArray = $infoToUpdateArray['phoneNumbers'];
            $numbersFromDB = $fetchedPersonModel->phoneNumbers()->get();
            foreach ($allNewNumbersArray as $aNumber) {
                $updated = false;
                foreach ($numbersFromDB as $theDBNumber) {
                    if ($aNumber['type'] == $theDBNumber->type) {
                        $theDBNumber->type = $aNumber['type'];
                        $theDBNumber->number = $aNumber['number'];
                        $theDBNumber->save();
                        $updated = true;
                    }
                }
                if ($updated == false) {
                    $theDBNumber = new PhoneNoModel();
                    $theDBNumber->type =$aNumber['type'];
                    $theDBNumber->number = $aNumber['number'];
                    $theDBNumber->save();
                }
            }
        }
        $fetchedPersonModel->save();
    }
    public function deletePerson(int $id): void
    {
        PersonModel::where('id', $id)->delete();
        PhoneNoModel::where('person_id', $id)->delete();
    }
}
