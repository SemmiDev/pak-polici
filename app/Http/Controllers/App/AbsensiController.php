<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');

        if ($date) {
            $daftarAbsensi = Absensi::whereDate('created_at', $date)->get();
            return view('app.absensi.index', compact('daftarAbsensi'));
        }

        $daftarAbsensi = Absensi::whereDate('created_at', date('Y-m-d'))->get();
        return view('app.absensi.index', compact('daftarAbsensi'));
    }

    public function create()
    {
        $daftarStatus = [
            'Hadir',
            'Izin',
            'Sakit',
            'Alpa',
            'Lainnya'
        ];

        return view('app.absensi.create', [
            'daftarStatus' => $daftarStatus,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'lokasi' => 'required|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $foto = $request->file('foto');
        $namaFoto = time() . '.' . $foto->extension();
        $foto->storeAs('public/absensi', $namaFoto);

        Absensi::create([
            'id_user' => auth()->user()->id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'foto' => $namaFoto,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('app.absensi.index')->with('success', 'Absensi berhasil ditambahkan');
    }
}