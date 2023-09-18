<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Succursale extends Model
{
    use HasFactory;
    public function amis():BelongsToMany{
        return $this->belongsToMany(Succursale::class,'amis',"from","to")->withPivot('accepted');
    }
}
