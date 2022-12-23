<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Status extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
    ];

    public function maintenance()
    {
        return $this->hasOne(Maintenance::class, 'status_id', 'id');
    }
}
