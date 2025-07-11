<?php

namespace App\Models\SC011;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
     use HasFactory;

    protected $table = 'evidences'; 
    protected $primaryKey = 'evidence_id'; 

    public $timestamps = false;

    protected $fillable = [
        'measure_survey_id',
        'warrant_result_id',
        'report_id',
        'collector_username',
        'case_id',
        'description',
        'date_collected',
        'status',
        'detailed_description',
        'initial_condition',
        'preservation_measures',
        'location_at_scene',
        'created_at',
        'attached_file',
        'is_deleted'
    ];
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'report_id');
    }

}
