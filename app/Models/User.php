<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];

    }
    public function salles()
    {
        return $this->hasMany(Salles::class);
    }
    public function parents()
    {
        return $this->hasMany(Parents::class);
    }
    public function inscription()
    {
        return $this->hasMany(Inscriptions::class);
    }
    public function student()
    {
        return $this->hasMany(Students::class);
    }

    public function payement()
    {
        return $this->hasMany(Payements::class);
    }

    public function teacher()
    {
        return $this->hasMany(Teachers::class);
    }
    public function cour()
    {
        return $this->hasMany(Cours::class);
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
