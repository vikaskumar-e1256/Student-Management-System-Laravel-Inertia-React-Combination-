<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'image', 'classes_id', 'roll_number'];

    public function studentClass()
    {
        return $this->belongsTo(Classes::class, 'classes_id', 'id');
    }

}
