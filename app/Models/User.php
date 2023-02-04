<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['email', 'nom', 'prenom', 'actif', 'date_creation', 'group_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
