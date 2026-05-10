<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScanLog extends Model
{
    protected $fillable = [
        'student_id',
        'operator_id',
        'attendance_session_id',
        'status',
        'message',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function session()
    {
        return $this->belongsTo(AttendanceSession::class, 'attendance_session_id');
    }
}