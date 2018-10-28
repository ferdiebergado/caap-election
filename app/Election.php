<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Candidate;

class Election extends Model
{
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
