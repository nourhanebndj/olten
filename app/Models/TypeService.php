<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeService extends Model
{
    use HasFactory;

    // Colonnes assignables en masse
    protected $fillable = [
        'nom',
        'description',
    ];

    /**
     * Relation : un TypeService a plusieurs Services
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
