<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
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
        'officer_approve_id',
        'is_deleted'
    ];

    public function evidences()
    {
        return $this->hasMany(Evidence::class, 'report_id', 'report_id');
    }
}