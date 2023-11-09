<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jobTitle',
        'provider',
        'phone',
        'bio',
        'photo',
        'approved'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
