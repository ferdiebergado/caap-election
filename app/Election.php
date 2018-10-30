<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Candidate;

class Election extends Model
{
    protected $fillable = [
        'title',
        'date',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
