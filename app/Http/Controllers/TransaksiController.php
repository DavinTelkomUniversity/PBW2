<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\User;
use App\Models\Koleksi;
use App\DataTables\TransaksiDataTable;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(TransaksiDataTable $dataTable)
    {
        return $dataTable->render('transaksi.daftarTransaksi');
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.infoTransaksi', compact('transaksi'));
    }

    public function create()
    {
        $users = User::all();
        $koleksi = Koleksi::where('jumlahSisa', '>=', 3)->get();
        return view('transaksi.registrasi', compact('users','koleksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.editTransaksi', compact('transaksi'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenisTransaksi' => 'required|string|max:255',
            'jumlahKeluar' => 'required|integer|max:' . Transaksi::find($id)->jumlahTransaksi,
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'jenisTransaksi' => $request->jenisTransaksi,
            'jumlahKeluar' => $request->jumlahKeluar,
            'jumlahSisa' => $transaksi->jumlahTransaksi - $request->jumlahKeluar,
        ]);

        return redirect()->route('transaksi.daftarTransaksi')->with('success', 'Transaksi berhasil diperbarui!');
    }
    
    public function store(Request $request)
{
    $request->validate([
        'idPeminjam' => 'required|integer',
        'transaksi1' => 'required|integer',
        'transaksi2' => 'required|integer',
        'transaksi3' => 'required|integer',
    ]);

    $transaksi = Transaksi::create([
        'idPetugas' => auth()->user()->id,
        'idPeminjam' => $request->idPeminjam,
        'tanggalPinjam' => Carbon::now(),
    ]);

    $koleksiIds = [$request->transaksi1, $request->transaksi2, $request->transaksi3];
    
    foreach ($koleksiIds as $koleksiId) {
        // Buat detail transaksi
        TransaksiDetail::create([
            'transaksiId' => $transaksi->id,
            'koleksiId' => $koleksiId,
            'status' => 1,
        ]);

        $koleksi = Koleksi::find($koleksiId);
        $koleksi->jumlahKeluar += 1;
        $koleksi->jumlahSisa -= 1;
        $koleksi->save();
    }

    // return redirect()->route('transaksi.daftarTransaksi')->with('success', 'Transaksi berhasil ditambahkan!');
    Session::flash('success', 'Transaksi berhasil ditambahkan!');
    return redirect()->route('transaksi.registrasi');
}
}
