<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassesSubject extends Model
{
    use HasFactory;

    protected $table = 'classes_subject';

    protected $fillable = ['classes_id', 'subject_id'];
}
