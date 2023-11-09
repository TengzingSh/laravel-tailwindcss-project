<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiries extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'firstName',
        'lastName',
        'email',
        'organName',
        'phone',
        'message',
        'trainer_id',
        'course_id'
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainers::class, 'trainer_id');
    }
    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
