<?php

namespace App;

use App\Voter;
use App\Election;
use App\BaseModel;
use App\Position;

class Candidate extends BaseModel
{
    protected $fillable = [
        'election_id',
        'voter_id',
        'position_id'
    ];

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
}
