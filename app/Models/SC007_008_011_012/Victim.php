<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
    use HasFactory;
    protected $table = 'victims'; 
    protected $primaryKey = 'victim_id'; 
    public $timestamps = false; 
    protected $fillable = [
        'case_id',
        'fullname',
        'contact',
        'injurie',
        'status',
        'is_deleted',
    ];
}
