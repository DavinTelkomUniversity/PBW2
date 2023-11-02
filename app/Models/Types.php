<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    use HasFactory;
// Nama    : Davin Wahyu Wardana
// NIM     : 6706223003
// Kelas   : D3IF-4603
protected $table = 'types';
    
protected $fillable = [
    'name',
    'status'
];
    public function create()
    {
        $types = Types::all();
        return view('vehicle.registrasi', compact('types'));
    }
}
