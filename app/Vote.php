<?php

namespace App;

use App\Election;
use App\Candidate;
use App\BaseModel;
use App\Voter;

class Vote extends BaseModel
{
    public function voter()
    {
        return $this->belongsTo(Voter::class);
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
