<?php

namespace App\Models;

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
}
