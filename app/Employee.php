<?php

namespace App;

use App\Vote;
use App\BaseModel;

class Employee extends BaseModel
{
    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'office'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
