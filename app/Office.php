<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

class Office extends Model
{
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
