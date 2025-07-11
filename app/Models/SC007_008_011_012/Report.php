<?php

namespace App\Models\SC007_008_011_012;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports'; 
    protected $primaryKey = 'report_id'; 
    public $timestamps = false;
    protected $fillable = [
        'case_id',
        'type_report',
        'description',
        'case_location',
        'reported_at',
        'reporter_fullname',
        'reporter_email',
        'reporter_phonenumber',
        'status',
        'officer_approve_username',
        'is_deleted'
    ];

     public function victims()
    {
        return $this->belongsToMany(Victim::class, 'report_victims', 'report_id', 'victim_id')
                    ->withPivot('is_deleted');
    }

   public function witnesses()
    {
        return $this->belongsToMany(Witness::class, 'report_witnesses', 'report_id', 'witness_id')
                    ->withPivot('is_deleted');
    }
}
