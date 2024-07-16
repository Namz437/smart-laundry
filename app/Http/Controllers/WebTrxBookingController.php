<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\TransaksiCucian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class WebTrxBookingController extends Controller
{
    public function index()
    {
        $dataaa = TransaksiCucian::with(['Users', 'Device'])->get();
        return view('trxbooking', ['dataaa' => $dataaa]);
    }

    public function destroy($id)
    {
        $trxbooking = TransaksiCucian::find($id);

        if (empty($trxbooking)) {
            return redirect()->route('trxbooking')->with('error', 'Transaksi Booking not found');
        }

        $trxbooking->delete();
        return redirect()->route('trxbooking')->with('success', 'Transaksi Booking ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $trxbooking = TransaksiCucian::find($id);

        if (is_null($trxbooking)) {
            return redirect()->route('trxbooking')->with('error', 'Transaksi Booking tidak ditemukan');
        }

        $users = User::all();
        $devices = Device::all();

        $user_selected = $trxbooking->users_id;
        $device_selected = $trxbooking->device_id;

        return view('edittrxbooking', compact('trxbooking', 'users', 'devices', 'user_selected', 'device_selected'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'users_id' => ['required'],
            'device_id' => ['required'],
            'waktu_cuci' => ['required'],
            'status_transaksi' => ['required'],
            'total_harga' => ['required'],
        ]);

        $trxbooking = TransaksiCucian::find($id);

        if (empty($trxbooking)) {
            return redirect()->route('trxbooking')->with('error', 'Transaksi Booking tidak ditemukan');
        }

        $trxbooking->users_id = $request->users_id;
        $trxbooking->device_id = $request->device_id;
        $trxbooking->waktu_cuci = $request->waktu_cuci;
        $trxbooking->status_transaksi = $request->status_transaksi;
        $trxbooking->total_harga = $request->total_harga;
        $trxbooking->save();

        return redirect()->route('trxbooking')->with('success', 'Transaksi Booking berhasil diperbarui');
    }
}
