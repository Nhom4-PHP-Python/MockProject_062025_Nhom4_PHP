<?php

namespace App\Models\SC007_008_011_012;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomplice extends Model
{
     use HasFactory;

    protected $table = 'accomplices';
    protected $primaryKey = 'accomplice_id';
    public $timestamps = false;

    protected $fillable = [
        'case_id',
        'fullname',
        'contact',
        'involvement',
        'status',
        'gender',
        'nationality',
        'description',
        'is_deleted'
    ];
    public function reports()
    {
        return $this->belongsToMany(Report::class, 'report_accomplices', 'accomplice_id', 'report_id')
                    ->withPivot('is_deleted');
    }
}
