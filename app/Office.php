<?php

namespace App;

use App\Voter;
use App\BaseModel;
use App\Candidate;

class Office extends BaseModel
{
    protected $fillable = [
        'name'
    ];

    protected $searchable = [
        'name'
    ];

    public function voters()
    {
        return $this->hasMany(Voter::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
