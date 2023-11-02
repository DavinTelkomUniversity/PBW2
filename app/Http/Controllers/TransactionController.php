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
    
}
