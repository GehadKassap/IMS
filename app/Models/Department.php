<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;
    use LogsActivity;

    protected $fillable = [
        'name',
        'code',
        'college_id',
        'study_system',
        'stages',
        'ects_count',
    ];

    public $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name','code','college_id','study_system','stages','ects_count']);
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }
}
