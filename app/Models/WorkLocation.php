<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkLocation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'description',
    ];
    
    public function assignments() {
    return $this->hasMany(Assignment::class);
    }

    public function tasks() {
    return $this->hasMany(Task::class);
    }

    public function volunteers() {
        return $this->belongsToMany(Volunteer::class, 'assignments');
    }
    
}
