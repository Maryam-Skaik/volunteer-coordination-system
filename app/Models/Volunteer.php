<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Volunteer extends Model
{
    use HasFactory;
    use softDeletes;

    public function assignments() {
    return $this->hasMany(Assignment::class);
    }

    public function workLocations() {
        return $this->belongsToMany(WorkLocation::class, 'assignments');
    }

    public function tasks() {
        return $this->belongsToMany(Task::class, 'assignments');
    }

    protected $fillable = ['name', 'email', 'phone', 'skills'];

}