<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'activity_category_id',
        'name',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(ActivityCategory::class, 'activity_category_id');
    }

    public function sessions()
    {
        return $this->hasMany(AttendanceSession::class);
    }
}