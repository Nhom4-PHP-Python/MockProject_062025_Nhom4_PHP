<?php

namespace App\Models\Sc009AndSc010;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Report extends Model
{
  protected $table = 'reports';
  protected $primaryKey = 'report_id';
  public $timestamps = false;

  // Specify the fillable fields for mass assignment
  protected $fillable = [
    'report_id',
    'reporter_fullname',
    'reported_at',
    'status',
    'case_id',
    'is_deleted'
  ];

  /**
   * Define the relationship between Report and Case.
   * Each report belongs to one case.
   */
  public function case()
  {
    return $this->belongsTo(Cases::class, 'case_id', 'case_id');
  }

  public static function getFilteredReports($filters)
  {
    $query = self::with('case')->where('is_deleted', 0);

    // Filter by report status
    if (!empty($filters['status'])) {
      $query->where('status', $filters['status']);
    }

    // Filter by case type using relationship
    if (!empty($filters['type'])) {
      $query->whereHas('case', function ($q) use ($filters) {
        $q->where('type_case', $filters['type']);
      });
    }

    // Filter by case severity using relationship
    if (!empty($filters['severity'])) {
      $query->whereHas('case', function ($q) use ($filters) {
        $q->where('severity', $filters['severity']);
      });
    }

    // Filter by report date range
    if (!empty($filters['created_at'])) {
      $dates = explode(' - ', $filters['created_at']);
      if (count($dates) === 2) {
        try {
          $start = Carbon::createFromFormat('m/d/Y', trim($dates[0]))->startOfDay();
          $end = Carbon::createFromFormat('m/d/Y', trim($dates[1]))->endOfDay();
          $query->whereBetween('reported_at', [$start, $end]);
        } catch (\Exception $e) {
          // Skip filtering if date format is invalid
        }
      }
    }

    // Return paginated results (12 reports per page)
    return $query->paginate(12);
  }
}
