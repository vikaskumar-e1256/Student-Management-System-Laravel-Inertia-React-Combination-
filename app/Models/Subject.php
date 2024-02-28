<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_active'];

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

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
    }
}
