<?php

namespace App\Models\SC007_008_011_012;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Witness extends Model
{
    use HasFactory;
    protected $table = 'witnesses'; 
    protected $primaryKey = 'witness_id'; 
    public $timestamps = false; 
    protected $fillable = [
        'case_id',
        'fullname',
        'contact',
        'statement',
        'is_deleted',
        'gender',
        'nationality',
        'description',
    ];
      public function reports()
    {
        return $this->belongsToMany(Report::class, 'report_witnesses', 'witness_id', 'report_id')
                    ->withPivot('is_deleted');
    }
}
