<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Queue\Failed\DatabaseFailedJobProvider;
use Illuminate\Support\Facades\DB;

class RekapAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date', date('Y-m-d'));

        $daftarAbsensi = DB::table('users')
            ->leftJoin('absensi', function ($join) use ($date) {
                $join->on('users.id', '=', 'absensi.id_user')->whereDate('tanggal', $date);
            })
            ->select('users.*', 'absensi.*')
            ->orderBy('users.name', 'asc')
            ->get();

        return view('app.rekap-absensi.index', compact('daftarAbsensi'));
    }

    public function rekapPerBulan(Request $request) {
        $defaultMonth = date('Y-m');

        $month = $request->query('month');
        if (!$month) {
            $month = $defaultMonth;
        }

        $year = substr($month, 0, 4);
        $month = substr($month, 5, 2);

        $daftarAbsensi = DB::table('users')
            ->leftJoin('absensi', function ($join) use ($month, $year) {
                $join->on('users.id', '=', 'absensi.id_user')
                    ->whereMonth('tanggal', $month)
                    ->whereYear('tanggal', $year);
            })
            ->select('users.id', 'users.name')
            ->selectRaw('SUM(CASE WHEN absensi.status = "Hadir" THEN 1 ELSE 0 END) as Hadir')
            ->selectRaw('SUM(CASE WHEN absensi.status = "Izin" THEN 1 ELSE 0 END) as Izin')
            ->selectRaw('SUM(CASE WHEN absensi.status = "Sakit" THEN 1 ELSE 0 END) as Sakit')
            ->selectRaw('SUM(CASE WHEN absensi.status = "Alpha" THEN 1 ELSE 0 END) as Alpha')
            ->selectRaw('SUM(CASE WHEN absensi.status = "Lainnya" THEN 1 ELSE 0 END) as Lainnya')
            ->groupBy('users.id', 'users.name')
            ->orderBy('users.name', 'asc')
            ->get();

        return view('app.rekap-absensi.rekap-per-bulan', compact('daftarAbsensi'));
    }
}
