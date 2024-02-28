<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = ['name', 'is_active'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
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
