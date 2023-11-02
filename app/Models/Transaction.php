<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    // Nama    : Davin Wahyu Wardana
    // NIM     : 6706223003
    // Kelas   : D3IF-4603
    protected $table = 'transaction';
    
    protected $fillable = [
        'userId',
        'vehicleId',
        'startDate',
        'endDate',
        'price',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicleId');
    }
}