<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
// Nama    : Davin Wahyu Wardana
// NIM     : 6706223003
// Kelas   : D3IF-4603
    protected $table = 'vehicle';
    
    protected $fillable = [
        'name',
        'typeId',
        'license',
        'dailyPrice',
        'status'
    ];

    public function types()
    {
        return $this->belongsTo(Types::class, 'typeId');
    }
    public function create()
    {
        $types = Types::all();
        return view('vehicle.registrasi', compact('types'));
    }
    public function scopeAvailableVehicles($query)
    {
        return $query->where('status', 2);
    }
}
