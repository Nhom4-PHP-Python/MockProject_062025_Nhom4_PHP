<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;
    protected $table = "reports";
    protected $fillable = [
        "report_id",
        "case_id",
        "type_report",
        "description",
        "case_location",
        "reported_at",
        "reporter_fullname",
        "reporter_email",
        "reporter_phonenumber",
        "officer_approve_id",
        "is_deleted",
    ];
}
