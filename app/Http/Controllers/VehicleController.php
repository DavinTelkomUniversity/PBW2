<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Vehicle;
use App\DataTables\VehicleDataTable;

class VehicleController extends Controller
{
    // Nama    : Davin Wahyu Wardana
    // NIM     : 6706223003
    // Kelas   : D3IF-4603
        
    public function index(VehicleDataTable $dataTable)
    {
        return $dataTable->render('vehicle.daftarVehicle');
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicle.infoVehicle', compact('vehicle'));
    }

    public function create()
    {
    return view('vehicle.registrasi');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicle.editVehicle', compact('vehicle'));
    }
    
    public function update(Request $request, $id)
    {
    }
    // Nama    : Davin Wahyu Wardana
    // NIM     : 6706223003
    // Kelas   : D3IF-4603
    public function store(Request $request)
    {
    }
}
