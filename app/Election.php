<?php

namespace App;

use App\Candidate;
use App\BaseModel;

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
}
