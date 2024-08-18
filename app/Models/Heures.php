<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heures extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'motif',
        'justif',
        'cours_id',
        'student_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function cour()
    {
        return $this->belongsTo(Cours::class, 'cour_id');
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
}
