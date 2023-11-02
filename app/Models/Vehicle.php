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
}
