<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Device;
use App\Models\TransaksiCucian;
use App\Models\TransaksiCucianAdd;
use App\Models\TransaksiCuciAsli;
use Exception;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $userCount = User::count();
            $perusahaanCount = Perusahaan::count();
            $deviceCount = Device::count();
            $TransaksiBookingCount = TransaksiCucian::count();

            // table
            $datas = Perusahaan::all();
            $dataa = User::all();
            $dat = Device::with(['Perusahaan', 'TypeCuci'])->get();
            $dataaa = TransaksiCucian::with(['Users', 'Device'])->get();

            

            return view('dashboard', [
                'userCount' => $userCount,
                'perusahaanCount' => $perusahaanCount,
                'deviceCount' => $deviceCount,
                'TransaksiBookingCount' => $TransaksiBookingCount,

                // untuk table
                'datas' => $datas,
                'dat' => $dat,
                'dataa' => $dataa,
                'dataaa' => $dataaa

                
            ]);
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan saat mengambil data.');
        }
    }
}
