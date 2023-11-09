<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id',
        'name',
        'duration',
        'dur_mode',
        'price',
        'min_parts',
        'max_parts',
        'level',
        'region',
        'certificate',
        'description',
        'format',
        'approved'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiries::class, 'trainer_id');
    }

}
