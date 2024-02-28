<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'image', 'classes_id', 'roll_number', 'is_active'];

    public function studentClass()
    {
        return $this->belongsTo(Classes::class, 'classes_id', 'id');
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
