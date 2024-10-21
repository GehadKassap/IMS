<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class College extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;
    use LogsActivity;

    protected $fillable = [
        'name',
        'code',
    ];

    public $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name','code']);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
