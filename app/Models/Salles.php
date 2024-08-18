<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salles extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'cycle',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function inscription()
    {
        return $this->hasMany(Inscriptions::class);
    }
    public function cour()
    {
        return $this->hasMany(Cours::class);
    }
}
