<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv',
        'opis',
        'cijena',
        'obavljeni_poslovi',
        'datum_pocetka',
        'datum_zavrsetka',
        'user_id', 
    ];

    
    public function voditelj()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clanovi()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }
}
