<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Maintenance extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_vehicle',
        'description',
        'reason',
        'deadline',
        'version',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id_vehicle', 'id');
    }
}
