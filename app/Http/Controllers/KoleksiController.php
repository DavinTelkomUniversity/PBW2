<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koleksi;

class KoleksiController extends Controller
{
    public function index() {
        $koleksi = Koleksi::all();
        return view('koleksi.daftarKoleksi', compact('koleksi'));
    }

    public function show($id)
    {
        $koleksi = Koleksi::findOrFail($id);
        return view('koleksi.infoKoleksi', compact('koleksi'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
    
    }
}
