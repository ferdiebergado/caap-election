<?php

namespace App;

use App\Vote;
use App\BaseModel;
use App\Office;

class Employee extends BaseModel
{
    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
    ];

    protected $searchable = [
        'lastname',
        'firstname',
        'middlename',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
