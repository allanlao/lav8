<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCoc extends Model
{
    use HasFactory;

    protected $table = 'leave_coc';
    protected $fillable = [
        'id',
        'employee_id',
        'date_issued',
        'description',
        'type',
        'osr_from',
        'osr_to',
        'hours',
        'balance',
       
   ];

   public function employee()
   {
       return $this->belongsTo('App\Models\Employee');
   }


}
