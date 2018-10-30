<?php

namespace App;

use App\Election;
use App\Candidate;
use App\BaseModel;
use App\Voter;
use App\Position;

class Vote extends BaseModel
{
    protected $fillable = [
        'voter_id',
        'position_id',
        'candidate_id',
        'election_id'
    ];

    protected $searchable = [];

    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
