<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscriptions extends Model
{
    use HasFactory;

    protected $fillable = [

        'salle_id',
        'student_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function salle()
    {
        return $this->belongsTo(Salles::class, 'salle_id');
    }
    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

}
