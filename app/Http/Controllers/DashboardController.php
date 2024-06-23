<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalPegawai = Pegawai::count();
        $totalLakiLaki = Pegawai::where('jenis_kelamin', 'L')->count();
        $totalPerempuan = Pegawai::where('jenis_kelamin', 'P')->count();
        $totalByJabatan = Pegawai::selectRaw('count(*) as total,  jabatan')
                            ->groupBy('jabatan')
                            ->get()
                            ->groupBy('jabatan')
                            ->map(fn ($item) => $item[0]->total);
        return view('dashboard', compact('totalPegawai', 'totalLakiLaki', 'totalPerempuan', 'totalByJabatan'));
    }
}
