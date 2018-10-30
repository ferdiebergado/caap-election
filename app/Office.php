<?php

namespace App;

use App\Voter;
use App\BaseModel;

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
}
