<?php

namespace App;

use App\Voter;
use App\Election;
use App\BaseModel;
use App\Position;
use App\Office;

class Candidate extends BaseModel
{
    protected $fillable = [
        'voter_id',
        'position_id',
        'election_id'
    ];

    protected $searchable = [];

    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}
