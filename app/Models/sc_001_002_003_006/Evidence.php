<?php

namespace App\Models\sc_001_002_003_006;

use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
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
        'detailed_description',
        'date_collected',
        'initial_condition',
        'attached_file',
        'status',
        'is_deleted',
        'preservation_measures',
        'location_at_scene'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'report_id');
    }
}