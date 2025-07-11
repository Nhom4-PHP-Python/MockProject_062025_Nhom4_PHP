<?php

namespace App\Models\SC007_008_011_012;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspect extends Model
{
    use HasFactory;
     protected $table = 'suspects';
    protected $primaryKey = 'suspect_id';
    public $timestamps = false; 
    protected $fillable = [
        'case_id',
        'suspect_role',
        'fullname',
        'national',
        'gender',
        'dob',
        'identification',
        'phonenumber',
        'description',
        'address',
        'catch_time',
        'notes',
        'status',
        'mugshot_url',
        'fingerprints_hash',
        'health_status',
        'is_deleted',
    ];
    public function reports()
    {
        return $this->belongsToMany(Report::class, 'report_suspects', 'suspect_id', 'report_id')
                    ->withPivot('is_deleted')
                    ->wherePivot('is_deleted', 0);
    }
}
