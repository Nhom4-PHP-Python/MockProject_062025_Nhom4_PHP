<?php

namespace App\Models\sc_001_002_003_006;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Party extends Model
{
    protected $table = 'relevant_parties';
    protected $primaryKey = 'id';
    protected $fillable = [
        'report_id',
        'fullname',
        'relationship',
        'gender',
        'nationality',
        'statement',
        'is_deleted',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'report_id');
    }
}
