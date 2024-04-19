<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    public function lignecommandes() {
        return $this->hasMany(LigneCommande::class, 'commande_id','id');
    }

    public function client() {
        return $this->belongsTo(User::class, 'client_id','id');
    }
    
    use HasFactory;
}
