<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Vehicle;
use App\Models\Types;
use App\DataTables\VehicleDataTable;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    // Nama    : Davin Wahyu Wardana
    // NIM     : 6706223003
    // Kelas   : D3IF-4603
        
    public function index(VehicleDataTable $dataTable)
    {
        return $dataTable->render('vehicle.daftarVehicle');
    }

    public function create()
    {
        $types = Types::all();
        return view('vehicle.registrasi')->with('types', $types);
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $types = Types::all();
        return view('vehicle.editVehicle', compact('vehicle', 'types'));
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'jenisVehicle' => 'required|exists:types,id',
            'license' => 'required|string|max:10',
            'price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('vehicle.editVehicle', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->name = $request->input('name');
        $vehicle->typeId = $request->input('jenisVehicle');
        $vehicle->license = $request->input('license');
        $vehicle->dailyPrice = $request->input('price');
        $vehicle->save();

        return redirect()->route('vehicle.editVehicle', $id)->with('success', 'Vehicle berhasil diperbarui!');
    }
    // Nama    : Davin Wahyu Wardana
    // NIM     : 6706223003
    // Kelas   : D3IF-4603
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'jenisVehicle' => 'required|exists:types,id',
            'license' => 'required|string|max:10',
            'price' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('vehicle.registrasi')
                ->withErrors($validator)
                ->withInput();
        }
    
        $vehicle = new Vehicle();
        $vehicle->name = $request->input('name');
        $vehicle->typeId = $request->input('jenisVehicle');
        $vehicle->license = $request->input('license');
        $vehicle->dailyPrice = $request->input('price');
        $vehicle->status = 3;
        $vehicle->save();
    
        return redirect()->route('vehicle.registrasi')->with('success', 'Vehicle berhasil ditambahkan!');
    }
}
