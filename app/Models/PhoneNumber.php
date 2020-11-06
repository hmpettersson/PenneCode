<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhoneNumber extends Model
{
    use HasFactory;
    protected $table= 'Phone_Number';

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'foreign_key');// kolla denna
    }
}
