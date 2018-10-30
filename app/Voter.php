<?php

namespace App;

use App\Vote;
use App\BaseModel;
use App\Office;
use App\Candidate;

class Voter extends BaseModel
{
    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'office_id'
    ];

    protected $searchable = [
        'lastname',
        'firstname',
        'middlename',
    ];

    protected $casts = [
        'voted' => 'boolean',
        'candidate' => 'boolean'
    ];

    protected $appends = [
        'fullname'
    ];

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucfirst($value);
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucfirst($value);
    }

    public function setMiddlenameAttribute($value)
    {
        $this->attributes['middlename'] = ucfirst($value);
    }

    public function getFullnameAttribute()
    {
        return $this->attributes['lastname'] . ', ' . $this->attributes['firstname'] . ' ' . $this->attributes['middlename'];
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
