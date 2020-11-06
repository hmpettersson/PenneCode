<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;
    protected $table= 'Person';

    public function phoneNumbers(): HasMany
    {
        return $this->hasMany(PhoneNumber::class, 'person_id', 'id');
    }
}
