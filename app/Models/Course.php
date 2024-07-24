<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'mentor',
        'title',
        'fee',
    ];

    // Relasi banyak-ke-banyak dengan model User
    public function users()
    {
        return $this->belongsToMany(User::class, 'userCourse', 'id_course', 'id_user');
    }

}
