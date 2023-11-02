<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Transaction;
use App\Models\Types;
use App\Models\User;
use App\Models\Vehicle;
use App\DataTables\TransactionDataTable;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(TransactionDataTable $dataTable)
    {
        return $dataTable->render('transaction.daftarTransaction');
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $users = User::all();
        $vehicles = Vehicle::availableVehicles()->get();
        return view('transaction.editTransaction', compact('transaction', 'users', 'vehicles'));
    }

    public function create()
    {
        $users = User::all();
        $vehicles = Vehicle::availableVehicles()->get();
        return view('transaction.registrasi', compact('users', 'vehicles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|exists:users,id',
            'vehicleId' => 'required|exists:vehicle,id',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        if ($validator->fails()) {
            return redirect()->route('transaction.registrasi')
                ->withErrors($validator)
                ->withInput();
        }

        $startDate = Carbon::parse($request->input('startDate'));
        $endDate = Carbon::parse($request->input('endDate'));
        $totalDays = $startDate->diffInDays($endDate);

        $vehicle = Vehicle::find($request->input('vehicleId'));
        $price = $vehicle->dailyPrice * $totalDays;

        $transaction = new Transaction();
        $transaction->userId = $request->input('userId');
        $transaction->vehicleId = $request->input('vehicleId');
        $transaction->startDate = $startDate;
        $transaction->endDate = $endDate;
        $transaction->price = $price;
        $transaction->status = 1;
        $transaction->save();

        $vehicle = Vehicle::find($request->input('vehicleId'));
        $vehicle->status = 1;
        $vehicle->save();

        return redirect()->route('transaction.registrasi')->with('success', 'Transaction berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'status' => 'required|in:1,2,3', 
    ]);

    if ($validator->fails()) {
        return redirect()->route('transaction.editTransaction', $id)
            ->withErrors($validator)
            ->withInput();
    }

    $transaction = Transaction::findOrFail($id);

    $transaction->status = $request->input('status');
    $transaction->save();

    if ($request->input('status') == 2) {
        $vehicle = Vehicle::find($transaction->vehicleId);
        $vehicle->status = 2;
        $vehicle->save();
    } elseif ($request->input('status') == 3) {
        $vehicle = Vehicle::find($transaction->vehicleId);
        $vehicle->status = 3;
        $vehicle->save();
    }

    return redirect()->route('transaction.daftarTransaction')->with('success', 'Transaksi berhasil diperbarui!');
}

    
}
