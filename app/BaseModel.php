<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Helpers\Searchable;

abstract class BaseModel extends Model
{
    use Cachable;
    use Searchable;
}
