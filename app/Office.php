<?php

namespace App;

use App\Employee;
use App\BaseModel;

class Office extends BaseModel
{
    protected $fillable = [
        'name'
    ];

    protected $searchable = [
        'name'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
