<?php

namespace App;

use App\Employee;
use App\Election;
use App\BaseModel;
use App\Position;

class Candidate extends BaseModel
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
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
