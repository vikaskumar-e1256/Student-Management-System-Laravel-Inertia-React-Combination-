<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_active'];

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
