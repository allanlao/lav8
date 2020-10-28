<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $appends = ['full_name'];

    public $incrementing = false;


    protected $fillable = [
        'id',
        'firstname',
        'middlename',
        'lastname',
        'username',
        'password',
        'position_id',
        'school_id',
        'entrance_to_duty',
        'gsis_no',
        'birthday',
        'gender',
        'civil_status',
        'email',
        'mobile',
        'employment_status',
        'tin',
        'is_active',
        'deleted_at'
        ];

        public function scopeFilter($query, array $filters)
        {
            $query->when($filters['search'] ?? null, function ($query, $search) {
                $query->where('lastname', 'like', '%'.$search.'%');
            })->when($filters['trashed'] ?? null, function ($query, $trashed) {
                if ($trashed === 'with') {
                    $query->withTrashed();
                } elseif ($trashed === 'only') {
                    $query->onlyTrashed();
                }
            });
        }

        public function getFullNameAttribute()
        {
            return "{$this->lastname}, {$this->firstname} {$this->middlename}";
        }

        public function position()
        {
            return $this->belongsTo('App\Models\Position');
        }

        public function school()
        {
            return $this->belongsTo('App\Models\School');
        }

        public function credits()
        {
            return $this->hasMany('App\Models\LeaveCredit');
        }

        public function cocs()
        {
            return $this->hasMany('App\Models\LeaveCoc');
        }
}
