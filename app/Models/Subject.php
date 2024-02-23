<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, ClassesSubject::class, 'subject_id', 'classes_id', 'id', 'classes_id');
    }
}
