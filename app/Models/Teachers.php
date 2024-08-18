<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'date',
        'adresse',
        'email',
        'tel',
        'matiere',
        'date2',
        'image',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function cour()
    {
        return $this->hasMany(Cours::class);
    }

    public function note()
    {
        return $this->hasMany(Notes::class);
    }

}
