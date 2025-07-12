<?php

namespace App\Models\Sc009AndSc010;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
  protected $table = 'cases';
  protected $primaryKey = 'case_id';
  public $timestamps = false;

  protected $fillable = [
    'case_id',
    'type_case',
    'severity',
  ];

  public function reports()
  {
    return $this->hasMany(Report::class, 'case_id', 'case_id');
  }
}
