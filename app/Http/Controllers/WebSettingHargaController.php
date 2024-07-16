<?php

namespace App\Http\Controllers;

use App\Models\SettingHarga;
use App\Models\TypeCuci;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class WebSettingHargaController extends Controller
{
    public function index()
    {
        $dat = SettingHarga::with(['TypeCuci'])->get();
        return view('settingharga', ['dat' => $dat]);
    }

    public function create()
    {
        $tipecuci = TypeCuci::all();
        return view('createsettingharga', compact('tipecuci'));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_cuci_id' => 'required',
            'harga_perKg' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $settingharga = SettingHarga::create([
                'type_cuci_id' => $request->type_cuci_id,
                'harga_perKg' => $request->harga_perKg,
            ]);

            return redirect()->route('settingharga')->with('success', 'Setting Harga created successfully.');
        } catch (Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());

            return redirect()->route('settingharga')->with('error', 'Terjadi kesalahan saat menambahkan Setting Harga.');
        }
    }

    public function destroy($id)
    {
        $settingharga = SettingHarga::find($id);

        if (empty($settingharga)) {
            return redirect()->route('settingharga')->with('error', 'Setting Harga not found');
        }

        $settingharga->delete();
        return redirect()->route('seettingharga')->with('success', 'Setting Harga ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $settingharga = SettingHarga::find($id);

        if (is_null($settingharga)) {
            return redirect()->route('settingharga')->with('error', 'Setting Harga tidak ditemukan');
        }

        $tipecuci = TypeCuci::all();

        $type_cuci_selected = $settingharga->TypeCuci ? $settingharga->TypeCuci->id : null;

        return view('editsettingharga', compact('settingharga','tipecuci', 'type_cuci_selected'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'type_cuci_id' => ['required'],
            'harga_perKg' => ['required'],
        ]);

        $settingharga = settingHarga::find($id);

        if (empty($settingharga)) {
            return redirect()->route('settingharga')->with('error', 'Setting Harga tidak ditemukan');
        }

        $settingharga->type_cuci_id = $request->type_cuci_id;
        $settingharga->harga_perKg = $request->harga_perKg;
        $settingharga->save();

        return redirect()->route('settingharga')->with('success', 'Setting Harga berhasil diperbarui');
    }
}
