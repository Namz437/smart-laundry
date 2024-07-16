<?php

namespace App\Http\Controllers;

use App\Models\TypeCuci;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class WebTypeCuciController extends Controller
{
    public function index()
    {
        try {
            $datas = TypeCuci::all();
            return view('typecuci', ['datas' => $datas]);
        } catch (Exception $th) {
            return redirect()->route('table')->with('error', 'Terjadi kesalahan saat mengambil data type cuci.');
        }
    }

    public function create()
    {
        $typecuci = TypeCuci::all();
        return view('createtypecuci'); // nama view sesuai
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_type' => 'required',
            'durasi_cuci' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $typecuci = TypeCuci::create([
                'nama_type' => $request->nama_type,
                'durasi_cuci' => $request->durasi_cuci,
            ]);

            return redirect()->route('typecuci')->with('success', 'Type Cuci created successfully.');
        } catch (Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());

            return redirect()->route('typecuci')->with('error', 'Terjadi kesalahan saat menambahkan Type Cuci.');
        }
    }

    public function destroy($id)
    {
        $typecuci = TypeCuci::find($id);

        if (empty($typecuci)) {
            return redirect()->route('typecuci')->with('error', 'Type Cuci not found');
        }

        $typecuci->delete();
        return redirect()->route('typecuci')->with('success', 'Type Cuci ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $typecuci = TypeCuci::find($id);

        if (empty($typecuci)) {
            return redirect()->route('typecuci')->with('error', 'Type Cuci tidak ditemukan');
        }

        return view('edittypecuci', ['typecuci' => $typecuci]); // Menggunakan view yang berbeda untuk edit
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama_type' => ['required'],
            'durasi_cuci' => ['required'],
        ]);

        $typecuci = TypeCuci::find($id);

        if (empty($typecuci)) {
            return redirect()->route('typecuci')->with('error', 'Type Cuci tidak ditemukan');
        }

        $typecuci->nama_type = $request->input('nama_type', $typecuci->nama_type);
        $typecuci->durasi_cuci = $request->durasi_cuci;
        $typecuci->save();

        return redirect()->route('typecuci')->with('success', 'Type Cuci berhasil diperbarui');
    }


}
