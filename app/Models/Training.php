<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $fillable = 
    ['employee_id','type','venue','title','date_from','date_to','hours','sponsor','encoded_by'];

    public function employee()
        {
            return $this->belongsTo('App\Models\Employee');
        }


}
