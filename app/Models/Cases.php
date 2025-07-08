<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    use HasFactory;
    protected $table = "cases";
    protected $fillable = [
        "case_id",
        "case_number",
        "type_case",
        "severity",
        "status",
        "summary",
        "create_at",
        "is_deleted",
        "report_id",
        "officer_id ",
    ];
}
