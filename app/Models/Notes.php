<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;

    protected $fillable = [
        'moy',
        'cours_id',
        'teacher_id',
        'student_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function cour()
    {
        return $this->belongsTo(Cours::class, 'cours_id');
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id');
    }
}
