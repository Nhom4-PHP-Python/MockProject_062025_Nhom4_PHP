<?php

namespace App\Models;

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
        'collected_by',
        'analyzed_by',
        'description',
        'collected_at',
        'current_location',
        'attached_file',
        'status',
        'is_deleted',
        'case_id'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'report_id');
    }
}