<?php

namespace App;

use App\Candidate;
use App\BaseModel;
use App\Position;
use App\Voter;

class Election extends BaseModel
{
    protected $fillable = [
        'title',
        'date',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $searchable = [
        'title'
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function voters()
    {
        return $this->hasMany(Voter::class);
    }
}
