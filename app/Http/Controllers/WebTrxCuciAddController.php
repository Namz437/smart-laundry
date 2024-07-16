<?php

namespace App\Http\Controllers;

use App\Models\Addition;
use App\Models\TransaksiCucian;
use App\Models\TransaksiCucianAdd;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class WebTrxCuciAddController extends Controller
{
    public function index()
    {
        $dat = TransaksiCucianAdd::with(['transaksicucian', 'Addition'])->get();
        return view('trxcuciadd', ['dat' => $dat]);
    }

    public function destroy($id)
    {
        $trxcuciadd = TransaksiCucianAdd::find($id);

        if (empty($trxcuciadd)) {
            return redirect()->route('trxcuciadd')->with('error', 'Transaksi Cucian Additional not found');
        }

        $trxcuciadd->delete();
        return redirect()->route('trxcuciadd')->with('success', 'Transaksi Cucian Additional ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $trxcuciadd = TransaksiCucianAdd::find($id);

        if (is_null($trxcuciadd)) {
            return redirect()->route('trxcuciadd')->with('error', 'Transaksi Cucian Additional tidak ditemukan');
        }

        $trxbooking = TransaksiCucian::all();
        $addition = Addition::all();

        $trxbooking_selected = $trxcuciadd->transaksi_cuci_id;
        $addition_selected = $trxcuciadd->addition_id;

        return view('edittrxcuciadd', compact('trxcuciadd', 'trxbooking', 'addition', 'trxbooking_selected', 'addition_selected'));
    }


    public function update($id, Request $request)
    {
        $request->validate([
            'transaksi_cuci_id' => ['required'],
            'addition_id' => ['required'],
            'jumlah' => ['required'],
            'total_harga' => ['required'],
        ]);

        $trxcuciadd = TransaksiCucianAdd::find($id);

        if (empty($trxcuciadd)) {
            return redirect()->route('trxcuciadd')->with('error', 'Transaksi Cucian Additional tidak ditemukan');
        }

        $trxcuciadd->transaksi_cuci_id = $request->transaksi_cuci_id;
        $trxcuciadd->addition_id = $request->addition_id;
        $trxcuciadd->jumlah = $request->jumlah;
        $trxcuciadd->total_harga = $request->total_harga;
        $trxcuciadd->save();

        return redirect()->route('trxcuciadd')->with('success', 'Transaksi Cucian Additional berhasil diperbarui');
    }
}
