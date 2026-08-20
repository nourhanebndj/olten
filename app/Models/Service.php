<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Colonnes assignables en masse
    protected $fillable = [
        'nom',
        'description',
        'image',
        'type_service_id',
    ];

    /**
     * Relation : un Service appartient à un TypeService
     */
    public function type()
    {
        return $this->belongsTo(TypeService::class, 'type_service_id');
    }
}
