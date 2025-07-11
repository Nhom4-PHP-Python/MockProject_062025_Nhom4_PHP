<?php

namespace App\Models\SC007_008_011_012;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
    use HasFactory;
    protected $table = 'victims'; 
    protected $primaryKey = 'victim_id'; 
    public $timestamps = false; 
     protected $fillable = [
        'case_id',
        'fullname',
        'contact',
        'injurie',
        'status',
        'is_deleted',
        'gender',
        'nationality',
        'description',
    ];
    // public function caseReport()
    // {
    //     return $this->belongsTo(Report::class, 'case_id', 'case_id');
    // }
      public function reports()
    {
        return $this->belongsToMany(Report::class, 'report_victims', 'victim_id', 'report_id')
                    ->withPivot('is_deleted');
    }
}
