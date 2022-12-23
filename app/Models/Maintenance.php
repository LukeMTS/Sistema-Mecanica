<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Maintenance extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'maintenances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_vehicle',
        'description',
        'deadline',
        'version',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id_vehicle', 'id');
    }

    public function status()
    {
        return $this->hasMany(Status::class, 'id', 'status_id');
    }
}
