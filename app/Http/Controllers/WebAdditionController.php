<?php

namespace App\Http\Controllers;

use App\Models\Addition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class WebAdditionController extends Controller
{
    public function index()
    {
        try {
            $datas = Addition::all();
            return view('addition', ['datas' => $datas]);
        } catch (Exception $th) {
            return redirect()->route('addition')->with('error', 'Terjadi kesalahan saat mengambil data Addition.');
        }
    }

    public function create()
    {
        $addition = Addition::all();
        return view('createaddition'); // nama view sesuai
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_addition' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $addition = Addition::create([
                'nama_addition' => $request->nama_addition,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                
            ]);

            return redirect()->route('addition')->with('success', 'Addition created successfully.');

        } catch (Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('addition')->with('error', 'Terjadi kesalahan saat menambahkan Addition.');
        }
    }

    public function destroy($id)
    {
        $addition = Addition::find($id);

        if (empty($addition)) {
            return redirect()->route('addition')->with('error', 'Addition not found');
        }

        $addition->delete();
        return redirect()->route('addition')->with('success', 'Addition ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $addition = Addition::find($id);

        if (empty($addition)) {
            return redirect()->route('addition')->with('error', 'Addition tidak ditemukan');
        }

        return view('editaddition', ['addition' => $addition]); // Menggunakan view yang berbeda untuk edit
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama_addition' => ['required'],
            'harga' => ['required'],
            'deskripsi' => ['required'],
        ]);

        $addition = Addition::find($id);

        if (empty($addition)) {
            return redirect()->route('addition')->with('error', 'Addition tidak ditemukan');
        }

        $addition->nama_addition = $request->input('nama_addition', $addition->nama_addition);
        $addition->harga = $request->harga;
        $addition->deskripsi = $request->deskripsi;
        $addition->save();

        return redirect()->route('addition')->with('success', 'Addition berhasil diperbarui');
    }



}
