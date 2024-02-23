<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'age', 'sex'];

    public function classes()
    {
        return $this->belongsToMany(Classes::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

}
