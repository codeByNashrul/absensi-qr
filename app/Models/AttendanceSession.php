<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    protected $fillable = [
        'activity_id',
        'operator_id',
        'title',
        'date',
        'start_time',
        'end_time',
        'is_active',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}