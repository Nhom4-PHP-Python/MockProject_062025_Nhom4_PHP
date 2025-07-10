<?php

namespace App\Models\SC012_013_016;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SC012_013_016\Report;

class Cases extends Model
{
    use HasFactory;
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'report_id');
    }

    //filter
    public static function filter($filters)
    {
        $query = self::with('report')->orderBy('case_id', 'ASC');

        if (!empty($filters['case_id'])) {
            $query->where('case_id', $filters['case_id']);
        }

        

        return $query;
    }
}
