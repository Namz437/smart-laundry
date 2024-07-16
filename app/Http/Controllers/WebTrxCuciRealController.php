<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\TransaksiCucian;
use App\Models\TransaksiCuciAsli;
use App\Models\User;
use Illuminate\Http\Request;



class WebTrxCuciRealController extends Controller
{
    public function index()
    {
        $dat = TransaksiCuciAsli::with(['transaksicucian', 'Device', 'Users'])->get();
        return view('trxcucireal', ['dat' => $dat]);
    }

    public function destroy($id)
    {
        $trxcuciasli = TransaksiCuciAsli::find($id);

        if (empty($trxcuciasli)) {
            return redirect()->route('trxcucireal')->with('error', 'Transaksi Cucian Realtime not found');
        }

        $trxcuciasli->delete();
        return redirect()->route('trxcucireal')->with('success', 'Transaksi Cucian Realtime ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $trxcuciasli = TransaksiCuciAsli::find($id);
    
        if (is_null($trxcuciasli)) {
            return redirect()->route('trxcucireal')->with('error', 'Transaksi Cucian Realtime tidak ditemukan');
        }
        
        $trxbooking = TransaksiCucian::all();
        $users = User::all();
        $devices = Device::all();
        
        $trxbooking_selected = $trxcuciasli->transaksi_cuci_id;
        $user_selected = $trxcuciasli->users_id;
        $device_selected = $trxcuciasli->device_id;
    
        return view('edittrxcucireal', compact('trxcuciasli', 'trxbooking', 'users', 'devices', 'trxbooking_selected', 'user_selected', 'device_selected'));
    }
    
    public function update($id, Request $request)
    {
        $request->validate([
            'transaksi_cuci_id' => ['required'],
            'users_id' => ['required'],
            'device_id' => ['required'],
            'waktu_cuci' => ['required'],
            'status_transaksi' => ['required'],
            'total_harga_cucian' => ['required'],
        ]);
    
        $trxcuciasli = TransaksiCuciAsli::find($id);
    
        if (empty($trxcuciasli)) {
            return redirect()->route('trxcucireal')->with('error', 'Transaksi Cucian Realtime tidak ditemukan');
        }
    
        $trxcuciasli->transaksi_cuci_id = $request->transaksi_cuci_id;
        $trxcuciasli->users_id = $request->users_id;
        $trxcuciasli->device_id = $request->device_id;
        $trxcuciasli->waktu_cuci = $request->waktu_cuci;
        $trxcuciasli->status_transaksi = $request->status_transaksi;
        $trxcuciasli->total_harga_cucian = $request->total_harga_cucian;
        $trxcuciasli->save();
    
        return redirect()->route('trxcucireal')->with('success', 'Transaksi Cucian Realtime berhasil diperbarui');
    }
    
}
