<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidences extends Model
{
    use HasFactory;
    protected $table = "evidences";
    protected $fillable = [
        "evidence_id",
        "measure_survey_id",
        "warrant_result_id",
        "report_id",
        "collected_by",
        "analyzed_by",
        "description",
        "collected_at",
        "current_location",
        "attached_file",
        "status",
        "is_deleted",
        "case_id ",
    ];

}
