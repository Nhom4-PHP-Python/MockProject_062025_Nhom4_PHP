<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Witness extends Model
{
    use HasFactory;
    protected $table = 'witnesses'; 
    protected $primaryKey = 'witness_id'; 
    public $timestamps = false; 
    protected $fillable = [
        'case_id',
        'fullname',
        'contact',
        'statement',
        'is_deleted',
    ];
}
