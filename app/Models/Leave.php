<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = [
        'date_filed',
        'employee_id',
        'type',
        'location',
        'location_type',
        'total_days',
        'inclusive_dates',
        'commutation',
       
        'total_approved_with_pay',
        'total_approved_without_pay',
        'total_approved_others',
        'vl_balance',
        'sl_balance',
        'disapproved_reason',
        'encoded_by',
      
        ];

        public function employee()
        {
            return $this->belongsTo('App\Models\Employee');
        }
}
