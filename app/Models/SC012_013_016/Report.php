<?php

namespace App\Models\SC012_013_016;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SC012_013_016\Cases;

class Report extends Model
{
    use HasFactory;
    public function cases()
    {
        return $this->hasMany(Cases::class, 'report_id');
    }
}
