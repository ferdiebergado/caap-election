<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class Position extends BaseModel
{
    protected $fillable = [
        'name'
    ];

    protected $searchable = [
        'name'
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
