<?php

namespace App;

use App\Employee;
use App\Election;
use App\Candidate;
use App\BaseModel;

class Vote extends BaseModel
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
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
