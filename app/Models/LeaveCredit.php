<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCredit extends Model
{
    use HasFactory;

    
    protected $table = 'leave_mc';
    protected $fillable = [
         
         'employee_id',
         'period',
         'credit',
         'balance',
         'remarks',

    ];

    public $incrementing = false;

    public function employee()
        {
            return $this->belongsTo('App\Models\Employee');
        }


}
