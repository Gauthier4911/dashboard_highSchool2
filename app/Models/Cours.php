<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'matiere',
        'heure',
        'date',
        'teacher_id',
        'salle_id',
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
    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id');
    }
    public function note()
    {
        return $this->hasMany(Notes::class);
    }
    public function heure()
    {
        return $this->hasMany(Heures::class);
    }
}
