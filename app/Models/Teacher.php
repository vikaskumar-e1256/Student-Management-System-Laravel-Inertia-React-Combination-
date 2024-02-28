<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'age', 'sex', 'is_active'];

    public function classes()
    {
        return $this->belongsToMany(Classes::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
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
