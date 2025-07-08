<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigationPlans extends Model
{
    use HasFactory;
    protected $table = "investigation_plans";
    protected $fillable = [
        "investigation_plan_id",
        "created_officer_id",
        "case_id",
        "deadline_date",
        "result",
        "status",
        "create_at",
        "plan_content",
        "is_deleted",
    ];
}
