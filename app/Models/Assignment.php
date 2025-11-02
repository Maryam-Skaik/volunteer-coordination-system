<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function volunteer() {
        return $this->belongsTo(Volunteer::class);
    }

    public function workLocation() {
        return $this->belongsTo(WorkLocation::class, 'work_location_id');
    }

    public function task() {
        return $this->belongsTo(Task::class, 'task_id');
    }

    protected $fillable = [
        'volunteer_id',
        'task_id',
        'work_location_id',
    ];
}
