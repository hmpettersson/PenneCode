<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Entities\Person;
use App\Entities\Address;
use App\Entities\NumbersCollection;
use App\Entities\PhoneNumber;
use App\Http\Controllers\Mappers\PersonMapper;

class PersonController extends Controller
{
    public function showAll(): JsonResponse
    {
        $personMapper = new PersonMapper();
        $personArray = $personMapper->findAllPersons();
        return response()->json($personArray);
    }
    /**
     * @param Request $request
     */
    public function createPersons(Request $request): void
    {
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $gender = $request->input('gender');
        $age = $request->input('age');
        $addressArray = $request->input('address');
        $address = new Address(
            $addressArray['streetAddress'],
            $addressArray['city'],
            $addressArray['state'],
            $addressArray['postalCode']
        );

        $allInfoAsArray = $request->input();
        $numbers = $allInfoAsArray['phoneNumbers'];
        $noCollection = new NumbersCollection();
        foreach ($numbers as $numberInfo) {
            $phoneNo = new PhoneNumber($numberInfo['type'], $numberInfo['number'], '');
            $noCollection->addPhoneNumber($phoneNo);
        }

        $person = new Person($firstName, $lastName, $gender, $age, $address, $noCollection);
        $personMapper = new PersonMapper();
        $personMapper->addPerson($person);
    }
    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id): Response
    {
        $personMapper = new PersonMapper();
        $person = $personMapper->getPersonById((int)$id);
        return response(json_encode($person, JSON_PRETTY_PRINT));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     */
    public function update(Request $request, string $id): void
    {
        $personMapper = new PersonMapper();
        $IdInDbCheck = $personMapper->getPersonById((int)$id);
        if (isset($IdInDbCheck)) {
            $allInfoAsArray = $request->input();
            $personMapper->updatePersons($allInfoAsArray, (int)$id);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     */
    public function destroyPersons(string $id): void
    {
        $personMapper = new PersonMapper();
        $personMapper->deletePerson((int)$id);
    }
}
