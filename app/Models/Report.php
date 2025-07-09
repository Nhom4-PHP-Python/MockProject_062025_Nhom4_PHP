<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cases;

class Report extends Model
{
    use HasFactory;
    public function cases()
    {
        return $this->hasMany(Cases::class, 'report_id');
    }
}
