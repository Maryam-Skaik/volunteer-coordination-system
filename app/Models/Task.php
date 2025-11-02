<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function workLocation() {
    return $this->belongsTo(WorkLocation::class);
    }

    public function volunteers() {
        return $this->belongsToMany(Volunteer::class, 'assignments');
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    protected $fillable = ['work_location_id', 'name', 'description'];
}
