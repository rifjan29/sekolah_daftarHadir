<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guru;
use App\Models\BukuTamu;
use App\Models\Presensi;

class DashboardController extends Controller
{
    private $params;

    public function index()
    {
        $this->params['admin'] = User::count();
        $this->params['guru'] = Guru::count();
        $this->params['tamu'] = BukuTamu::count();
        $this->params['tamuHariIni'] = BukuTamu::whereDate('created_at', date('Y-m-d'))->count();
        $this->params['presensiHariIni'] = Presensi::where('presensi', 'Hadir')->whereDate('created_at', date('Y-m-d'))->count();
        $this->params['absenHariIni'] = Presensi::where('presensi', 'Absen')->whereDate('created_at', date('Y-m-d'))->count();
        $this->params['alpaHariIni'] = Presensi::where('presensi', 'Alpa')->whereDate('created_at', date('Y-m-d'))->count();

        return view('dashboard', $this->params);
    }
  
}
