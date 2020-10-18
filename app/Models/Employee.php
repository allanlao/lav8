<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

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
        ];

        public function scopeFilter($query, array $filters)
        {
            $query->when($filters['search'] ?? null, function ($query, $search) {
                $query->where('lastname', 'like', '%'.$search.'%');
            })->when($filters['inactive'] ?? null, function ($query, $inactive) {
                if ($inactive === 'with') {
                    $query->withInactive();
                } elseif ($trashed === 'only') {
                    $query->onlyInactive();
                }
            });
        }

        public function getFullNameAttribute()
        {
            return "{$this->lastname}, {$this->firstname} {$this->middlename}";
        }

        public function positions()
        {
            return $this->belongsTo(Position::class);
        }

        public function schools()
        {
            return $this->belongsTo(School::class);
        }
}
