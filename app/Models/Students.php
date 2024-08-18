<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'date',
        'adresse',
        'email',
        'tel',
        'image',
        'parent_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parent_id');
    }
    public function inscription()
    {
        return $this->hasMany(Inscriptions::class);
    }
    public function payement()
    {
        return $this->hasMany(Payements::class, 'student_id');
    }
    public function hasCompletedPayment()
    {
        $totalPaiement = $this->payement()->sum('montant');
        if ($totalPaiement == 0) {
            return null;
        }
        return $totalPaiement >= 400000;
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
